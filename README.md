################################################
# Gestion d'utilisateurs avec Slim Framework 3 #
################################################

Etapes d'installation: 
- configurer les parametres mysql dans le fichier /authentification/app/settings.php
- lancer wamp, importer le fichier installationbdd.sql dans phpmyadmin
- configurer un hôte virtuel sur le dossier "/authentification/public" pour pouvoir y accéder ainsi http://vhost.dev (redémarrage service wamp nécessaire)
en effet l'application ne sera pas fonctionnelle, si vous vous rendez directement à l'adresse http://localhost/authentification/public/

Pour la mise à jour des librairies externes, utiliser composer à la racine du dossier authentification :
php composer.phar update
