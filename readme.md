# ecoride

PROJET ECF 2025 - Ecoride site de covoiturage écologique

## Description

Voici mon dépôt pour mon entraînement ECF visant à la création d'un site pour une entreprise "EcoRide".
Je tiens à m'excuser pour les quelques problèmes du site, avec le travail et mon projet final, j'ai peu de temps mais j'ai tout donné !
L'application en local est entièrement fonctionnelle si bien configurée, merci de me joindre si quelconque problème s'impose.
Lors de mes derniers tests, toutes les fonctionnalités principales fonctionnaient excepté le register qui crée une erreur.

## Exécution en ligne

https://ecoride-summer-butterfly-9093.fly.dev
Fly.io ne cesse de me poser problème, si lors de ma correction vous pouviez m'y aider, j'en serais ravi :)

## Exécution en local

Pour exécuter cette application localement, suivez ces étapes :

1. Assurez-vous d'avoir installé PHP, Composer et Symfony CLI sur votre machine.
2. Clonez ce référentiel sur votre machine :
   ```bash
   git clone https://github.com/Nolhan8/ecoride.git)https://github.com/Nolhan8/ecoride.git
   ```

accéder au répertoir de l'application

- cd nom-du-repertoire

Installez les dépendances PHP en exécutant la commande suivante :

- composer install

Configurez votre fichier .env avec les paramètres appropriés, tels que la connexion à la base de données.

Créez la base de données et exécutez les migrations :

- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate

Lancez le serveur Symfony :

- symfony server:start

Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000.

Création d'un compte administrateur
Pour créer un compte administrateur pour accéder au back office de l'application, suivez ces étapes :

Accédez au fichier src/command/CreateAdminCommand.php
Personnalisez les informations de connexion et executez la commande

- php bin/console create:admin

Par défaut :
-Username : admin
-Email : admin@example.com
-Role: admin
-Firstname: Jose
-Lastname: Ecoride
-Password: admin123

Pour accéder à la page admin/dashboard il vous faut vous connecter avec un compte admin
Pour accéder à la page user/dashboard il vous faut vous connecter avec un compte user

# A NOTER

Ce projet est dédié a mon ECF pour la plateforme STUDI, s'il y a quelconque problème avec la lecture de mon site ou son utilisation MERCI DE ME CONTACTER VIA LA PLATEFORME DE FORMATION
A savoir également, qu'il y a notamment quelques erreurs dans mon projet dont je suis conscient et prêt à les corriger si nécessaire avec plus de temps.

- Problème avec l'authentification, il n'y a donc pas vraiment d'authentification ou de sécurité pour accéder à des pages comme admin/dashboard
- J'ai essayé de corriger un petit problème sur ma fonctionnalité de filtre au dernier moment, et depuis je n'arrive plus a la faire fonctionner correctement et j'en suis navré
