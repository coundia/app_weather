# Guide Complet


# Lancer le projet

composer start

### References des dependances (DEVS)  

[https://getcomposer.org/](https://getcomposer.org/)
[https://phpunit.de/](https://phpunit.de/)
[https://codeception.com/quickstart](https://codeception.com/quickstart)

    composer require --dev codeception/codeception  phpunit/phpunit symfony/var-dumper
#### Codeception pour les tests d'integration
composer require "codeception/codeception" --dev
php vendor/bin/codecept bootstrap
php vendor/bin/codecept generate:cest acceptance First

 - Ecrire un test d'integration

1. Edit **tests/acceptance.suite.yml** to set url of your application. Change PhpBrowser to WebDriver to enable browser testing
2. Edit **tests/functional.suite.yml** to enable a framework module. Remove this file if you don't use a framework
3. Create your first acceptance tests using **php vendor/bin/codecept g:cest acceptance First**
4. Write first test in **tests/acceptance/FirstCest.php**
5. Run tests using: **php vendor/bin/codecept run**



### References des dependances 

[https://packagist.org/packages/vlucas/phpdotenv](https://packagist.org/packages/vlucas/phpdotenv)

composer require vlucas/phpdotenv  
 
### Cloud Heroku
https://dashboard.heroku.com
#### Deploiement
heroku login
- ajout repo
heroku git:remote -a cnd-app-weather
-deploy
git push heroku main
### Guides

