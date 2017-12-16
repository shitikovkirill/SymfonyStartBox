Template for starting a new project on Symfony
=============================================

### Description

1. PHP 7.1
2. Symfony 3.3
3. Sqlite

### Installed Bundles

1. Sonata Admin Bundle
2. Fos user bundle

### Start
```
docker-compose up

docker-compose run --rm web bin/console asserts:install

docker-compose run --rm web bin/console doctrine:schema:create

docker-compose run --rm web bin/console fos:user:create
```

Run in browser: [locashost:8000](http://locashost:8000)

### XDebug

For run in PHPStorm
Settings->PHP->Servers

Add
Host: 0.0.0.0 
Port: 8000
Debugger: Xdebug

Check Use path mappings

/local/path/to/project | /var/www/symfony

Click -> Start Listening for PHP Debug Connection

Add break point

