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
composer inter

### References des dependances 
- gerer les constantes .env
[https://packagist.org/packages/vlucas/phpdotenv](https://packagist.org/packages/vlucas/phpdotenv)
composer require vlucas/phpdotenv  
 
### Cloud Heroku
[https://dashboard.heroku.com](https://dashboard.heroku.com)
heroku login
- ajout repo
heroku git:remote -a cnd-app-weather
-deploy
git push heroku main

### Moteur de template twig
[https://twig.symfony.com/](https://twig.symfony.com/)
composer require twig/twig

## Images
https://unsplash.com/photos/da2QXQ-c1q0