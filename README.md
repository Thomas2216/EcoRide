# 🚗 EcoRide

Plateforme de covoiturage développée avec **Symfony 7.3**, **MySQL** et **MongoDB**,
dans le cadre du **Titre Professionnel DWWM (Développeur Web et Web Mobile)**.

> ⚠️ Projet d'école en cours de développement — certaines fonctionnalités sont partielles
> ou non implémentées. Le socle technique est fonctionnel.

---

## Stack technique

- **Back-end** : PHP 8.2 / Symfony 7.3 / Doctrine ORM / Doctrine MongoDB ODM
- **Base de données** : MySQL 8.0 + MongoDB 7 (statistiques de visites)
- **Front-end** : Twig / Bootstrap 5.3 / Stimulus.js / Turbo
- **Infrastructure** : Docker, Docker Compose, Apache 2.4
- **Tests** : PHPUnit 11.5, PHPStan

---

## Prérequis

- Docker & Docker Compose
- Git

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/Thomas2216/ecoride.git
cd ecoride
```

### 2. Configurer l'environnement

```bash
cp .env .env.local
```

Modifier `.env.local` :

```env
DATABASE_URL="mysql://root:root@mysql:3307/utilisateur_ecoride"
MONGODB_URL="mongodb://mongodb:27017"
MONGODB_DB="ecoride"
APP_SECRET=votre_secret_ici
```

### 3. Lancer Docker

```bash
docker-compose up -d
```

### 4. Installer les dépendances

```bash
docker exec -it php-symfony composer install
```

### 5. Créer la base de données et charger les fixtures

```bash
docker exec -it php-symfony php bin/console doctrine:database:create
docker exec -it php-symfony php bin/console doctrine:schema:create
docker exec -it php-symfony php bin/console doctrine:fixtures:load
```

### 6. Accéder à l'application

L'application est accessible sur **http://localhost:8080**

---

## Comptes de démonstration

Mot de passe pour tous les comptes : `Demo1234!`

| Rôle          | Email                  | Type          |
|---------------|------------------------|---------------|
| Administrateur | alice@ecoride.fr      | les_deux      |
| Employé        | employe@ecoride.fr    | passager      |
| Utilisateur    | user@ecoride.fr       | conducteur    |

---

## Fonctionnalités

### ✅ Implémentées et fonctionnelles

- Inscription et connexion (remember me 7 jours, protection CSRF)
- Authentification par rôles : ROLE_USER / ROLE_EMPLOYEE / ROLE_ADMIN
- Hiérarchie des rôles et redirection post-login selon le rôle
- Affichage de la liste des covoiturages disponibles (avec conducteur, véhicule, note moyenne)
- Création d'un covoiturage (formulaire complet, persistance BDD)
- Choix du type de profil : passager / conducteur / les deux
- Statistiques de visites en temps réel (MongoDB) — dashboard admin
- Conteneurisation complète Docker (MySQL + MongoDB + PHP/Apache)
- Fixtures de test (utilisateurs, véhicules, trajets, avis)
- Architecture MVC propre (entités, repositories, service métier, formulaires)

### ⚠️ Partiellement implémentées

- Dashboard admin — page accessible, sans gestion des utilisateurs
- Dashboard employé — page accessible, sans fonctionnalités
- Mes covoiturages — structure en place, liste non peuplée
- Mes réservations — structure en place, non fonctionnel
- Formulaire de recherche — présent dans la navbar, non relié au back-end

### ❌ Non implémentées

- Système de réservation (booking réel)
- Recherche et filtrage des covoiturages
- Modération des avis
- Gestion admin des utilisateurs
- Messagerie entre utilisateurs
- Notifications par email
- Upload de photo de profil

---

## Architecture du projet

```
src/
├── Controller/      # 7 contrôleurs
├── Entity/          # 4 entités Doctrine
├── Document/        # 1 document MongoDB
├── Repository/      # 5 repositories
├── Service/         # CovoiturageService
├── Form/            # 2 formulaires
├── Security/        # Authenticateur personnalisé
└── DataFixtures/    # Fixtures de test
templates/
├── base.html.twig
└── pages/           # 12 templates Twig
docker-compose.yml
Dockerfile
```

---

## Docker — Services

| Service       | Port local | Description              |
|---------------|------------|--------------------------|
| php-symfony   | 8080       | Apache + PHP 8.2         |
| mysql         | 3307       | MySQL 8.0                |
| mongodb       | 27017      | MongoDB 7                |

---

## 👨‍💻 Auteur

**Thomas Valle** — Développeur Web PHP/Symfony | TP DWWM
[LinkedIn](https://www.linkedin.com/in/thomas-valle-dev/) • [GitHub](https://github.com/Thomas2216/EcoRide)

---

## 📄 Licence

Projet réalisé dans un cadre pédagogique — Studi, 2025.

## Architecture du projet
