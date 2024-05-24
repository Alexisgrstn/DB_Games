GAME NOTATION



Présentation du Projet :

Ce projet a pour objectif de réaliser une application web permettant la gestion de jeux vidéo.
L'infrastructure doit être décomposée en deux machines:

-Une machine pour gérer la base de données (DatabaseServer).

-Une autre machine pour l'application de gestion (BackOfficeServer).

-L'application doit permettre de réaliser un CRUD (Create, Read, Update, Delete) complet pour les jeux vidéo.




FONCTIONNALITE DE L'APPLICATION

Un jeu vidéo doit avoir les attributs suivants :

-Un nom
-Une image
-Une maison d'édition
-Une évaluation
-La date d'évaluation

L'application doit permettre de :

-Lister les jeux vidéo (index.php)
-Afficher les détails d'un jeu (show.php)
-Modifier les informations d'un jeu (edit.php)
-Créer un nouveau jeu (create.php)
-La date d'évaluation doit être automatiquement mise à jour lors de la création ou de la modification d'un enregistrement.



PREREQUIS:

-Serveur web (Apache, Nginx, etc.)
-PHP 7.4 ou supérieur
-Une base de données MySQL
-Composer pour la gestion des dépendances



INSTALLATION:

-Clonez le dépot: https://github.com/Alexisgrstn/DB_Games.git
-Lancer Apache 
-Lancer MySQL
-aller sur votre navigateur web 
-taper [localhost://](http://localhost/DB_Games/src/)

Naviguez dans les jeux vidéo, visualisez leurs détails, et modifiez les informations selon vos besoins.



STACK TECHNIQUE:

-Langage : PHP
-Framework CSS : Bootstrap
-Base de données : MySQL



CONTRAINTES:

-Le projet doit être réalisé en groupe de 2 personnes.
-La base de données doit être sécurisée, sans utilisation directe du compte root pour le back office.
-L'utilisateur connecté à la base de données ne doit pouvoir se connecter qu'à partir de l'IP du serveur du back office.



BONUS:

Un bonus sera accordé aux projets proposant des fonctionnalités avancées :

-Reverse proxy
-Connexion SSH sur les serveurs
-Sauvegarde automatisée de la base de données
-Logs
-Load balancer pour la base de données




LIVRABLES ATTENDU:

Le dépôt GIT doit contenir un fichier README avec :

-Le but du projet
-Le cadre de développement du projet
-La stack technique choisie
-Comment installer le projet
-Un screenshot de l'application finale
-Le code source de l'application
-La documentation technique
-La structure de la base de données
-Une documentation d’architecture
-L'infrastructure mise en place
-La communication réalisée entre l'application et la base de données
-Les ports alloués ainsi que la sécurité mise en place
-L’utilisation des outils/services mis en place (ex: sauvegarde automatisée, restauration)




CADRE DE DEVELOPPEMENT:

Ce projet a été créé par deux étudiants en première année d'informatique sur une durée de sept demi-journées. La base de données devait être sécurisée.



AUTEURS:

-Alexis
-Tyfenn