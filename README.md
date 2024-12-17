# Application-de-gestion-d-une-agence-de-location-de-vehicules-avec-reservation-en-ligne
État d'avancement du projet
1-Objectif du projet :
Développement d'une application web pour gérer une agence de location de véhicules avec réservation en ligne.
2-Technologies utilisées :
Backend : PHP, basé sur le modèle MVC (Modèle-Vue-Contrôleur).
Base de données : MySQL, gérée via phpMyAdmin.
Environnement de développement : XAMPP (serveur local), Visual Studio Code et IntelliJ IDEA comme éditeurs de code.
3-Avantages du modèle MVC :
Clarté et organisation : Le code est mieux organisé, ce qui facilite la gestion et les mises à jour.
Réutilisabilité : Le modèle permet de réutiliser des composants (modèles, vues et contrôleurs) dans d'autres parties de l'application.
Maintenance simplifiée : Les modifications dans une partie de l’application (par exemple, la logique métier) n'affectent pas les autres parties.
4-Avancement du développement :
Connexion à la base de données établie avec des fonctionnalités permettant d'ajouter, de modifier, de supprimer et de lister des véhicules.
Le modèle Vehicule et son contrôleur VehiculeDAO permettent de gérer les informations des véhicules dans la base de données.
Ajout de la gestion des types de véhicules (Voiture, Moto, etc.) avec une validation pour éviter les types incorrects.
Base de données :
La structure de la base de données est prête, avec les tables vehicule, client, reservation, administrateur, etc.
Les tables sont liées entre elles avec des clés primaires et étrangères, permettant de gérer les relations entre les entités.
5-Étapes suivantes :
1. Finaliser le Backend :
Vérification de la logique des API :

Vérifiez que chaque fonction du backend (comme l'ajout, la suppression, la mise à jour des véhicules) fonctionne correctement.

