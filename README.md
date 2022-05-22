# app_weather

# Objectif

**Charger** et **analyser** les données de température du mois de juillet 2015 à Québec en langage PHP et les afficher
sous format HTML.

À partir du fichier XML (eng-hourly-07012015-07312015.xml) contenant les données de température horaire du mois de
juillet 2015.

# Solution meilleur Jour pour assister

    Question 2 : Trouver et expliquer (dans un commentaire) le meilleur jour pour assister à un spectacle
    musical extérieur en soirée durant le festival d’été qui s’est déroulé du 9 au 19 juillet

##

bestDaySummerEvent(\Datetime $debut ,\Datetime $fin): \Datetime {

}

# INSTALLATION

## Prerequis

    PHP 7.2.5 ou plus.

## installer les dependences

    composer install
    cp .env.dist .env

## Lancer les tests unitaires
    composer tests

## Lancer les tests d' interations
    composer interation_test

## Lancer le projet
    composer start

## Lien de tests

[https://cnd-app-weather.herokuapp.com/](https://cnd-app-weather.herokuapp.com/)


