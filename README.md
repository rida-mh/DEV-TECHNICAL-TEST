# DEV-TECHNICAL-TEST

## A propos
Ce repository contient un test technique à réaliser par les candidats au poste de développeur à Enera Conseil.

Les consignes à respecter sont détaillées dans ci-dessous.


## Consignes

### Mise en contexte

Vous êtes développeur sur un nouveau projet commandé par une bibliothèque afin de gérer ses livres. L'objectif du projet est de fournir une petite plateforme Web permettant de facilement enregistrer les livres présents dans la bibliothèque. Le client a insisté sur le fait que le produit devrait pouvoir évoluer facilement en fonction des nouveaux besoins.

Ce repository contient le résultat de la toute première itération du projet au cours de laquelle vous avez commencé à dessiner une architecture.

### Tâches à réaliser

#### Tâche 1 : Gestion des codes ISBN

Une API permettant d'ajouter un livre existe déjà. Toutefois il manque un élément important permettant d'identifier de manière unique les livres : le code ISBN.

Le but est donc d'intégrer la gestion des codes ISBN au niveau des livres. A noter que dans l'application, il ne peut y avoir deux livres avec le même code ISBN.

Vous trouverez des [informations sur les code ISBN ici.](https://www.bnf.fr/fr/isbn#:~:text=L'ISBN%20%E2%80%93%20International%20Standard%20Book,de%20publication%20%3A%20imprim%C3%A9%20ou%20multim%C3%A9dia.)

#### Tâche 2 : Interface graphique

Il est temps d'intégrer les premiers éléments d'interface graphique dans l'application.

Le but de cette tâche est de créer une interface graphique qui permet de lister les livres déjà ajoutés, et d'en ajouter des nouveaux.

### Contraintes et remarques générales

Le candidat est libre d'effectuer les tâches de la manière qu'il souhaite, avec pour unique contrainte que tout le code doit pouvoir être executé via le docker déjà présent dans le repository.

Par ailleurs, à la suite du test technique, un échange est prévu pour discuter des choix qui ont été fait. Il est clair que les problématiques présentées ici sont très simples, mais il est demandé au candidat de comprendre l'esprit du test à partir du code existant fourni.

Enfin, l'absence d'authentification et de base de données est voulue pour simplifier la mise en place du test, il n'est pas demandé au candidat de "corriger" cela.

## Installation de l'application

Une fois le repository cloné, voici les étapes à suivre pour lancer l'application.

1) Créer et éxecuter l'image docker

`docker-compose -f docker-compose.yml up --build`

2) Depuis le docker, installer les dépendances

`composer install`

3) Depuis le docker, initialiser le répertoire permettant le stockage des données en locale

`mkdir -p /var/www/html/src/Infrastructure/Database/Data`

`chown -R www-data:www-data /var/www/html/src/Infrastructure/Database/Data`

`chmod -R 755 /var/www/html/src/Infrastructure/Database/Data`


L'application est executée sur le port 8000 du localhost. De base, deux API sont configurées :

`[GET] http://localhost:8000/api/books`

`[GET] http://localhost:8000/api/books/{bookID}`

`[POST] http://localhost:8000/api/books`


Les routes sont définies dans le fichier : `/src/Infrastructure/Slim/Routes.php`
