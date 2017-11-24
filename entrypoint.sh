#!/bin/sh

# mkdir dir for PID file
mkdir /run/mysqld/
chown mysql /run/mysqld/

# install DB
mysql_install_db --user=mysql --datadir=${DB_DATA_PATH}

# run a daemon
/usr/bin/mysqld \
    --basedir=/usr \
    --datadir=${DB_DATA_PATH} \
    --plugin-dir=/usr/lib/mysql/plugin \
    --user=mysql \
    --log-error=${DB_DATA_PATH}/mysql.err \
    --pid-file=mysql.pid \
    --socket=/run/mysqld/mysqld.sock \
    --port=3306 \
    &

# wait for mysql to startup
echo -n 'Waiting for mysqld'
until mysqladmin ping --silent; do
  echo -n "."; sleep 0.2
done

# change root password
mysqladmin -u root password "${DB_ROOT_PASS}"

# add new user and drop "test" DB
echo "GRANT ALL ON *.* TO ${DB_USER}@'127.0.0.1' IDENTIFIED BY '${DB_PASS}' WITH GRANT OPTION;" > /tmp/sql
echo "GRANT ALL ON *.* TO ${DB_USER}@'localhost' IDENTIFIED BY '${DB_PASS}' WITH GRANT OPTION;" >> /tmp/sql
echo "GRANT ALL ON *.* TO ${DB_USER}@'::1' IDENTIFIED BY '${DB_PASS}' WITH GRANT OPTION;" >> /tmp/sql
echo "DELETE FROM mysql.user WHERE User='';" >> /tmp/sql
echo "DROP DATABASE test;" >> /tmp/sql
echo "FLUSH PRIVILEGES;" >> /tmp/sql
cat /tmp/sql | mysql -u root --password="${DB_ROOT_PASS}"

# mkdir dir for PID file
mkdir /run/apache2/
chown apache /run/apache2/

# run apache daemon
/usr/sbin/httpd


# install trap for killing daemons
shutdown()
{
    echo "Caught Signal ... shutting down"
    kill $(cat /run/mysqld/mysql.pid)
    kill $(cat /run/apache2/httpd.pid)
}

trap 'shutdown' TERM INT

tail -f /var/www/logs/error.log /var/www/logs/access.log ${DB_DATA_PATH}/mysql.err

exec wait
