VolunTree - Backend (API REST)

API REST de VolunTree, une plateforme de gestion de bénévolat qui met en relation des bénévoles et des associations. Projet de fin d'études (PFE) du diplôme Développement Digital, option Web Full Stack (OFPPT).

Ce dépôt contient le backend (Laravel). Le frontend (React.js) est ici : https://github.com/abkourdouaa-glitch/Frontend_VolunTree  

Fonctionnalités:
Authentification sécurisée par token avec Laravel Sanctum
Gestion de deux rôles : bénévoles et associations
CRUD des missions
Système de candidatures (dépôt, acceptation, refus)
Gestion du profil et upload de photo
Génération du Pass Bénévole en PDF (barryvdh/laravel-dompdf)
Configuration CORS pour le frontend React
Technologies
PHP / Laravel 10
MySQL
Laravel Sanctum
barryvdh/laravel-dompdf

Installation:
# 1. Cloner le dépôt
git clone https://github.com/abkourdouaa-glitch/Backend_VolunTree.git
cd Backend_VolunTree

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé de l'application
php artisan key:generate

# 5. Configurer la base de données dans le fichier .env (MySQL) puis lancer les migrations
php artisan migrate --seed

# 6. Lancer le serveur local
php artisan serve
