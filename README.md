# Projet technique : gestion des offres d'emploi

## Sujet du projet

Ce projet consiste à développer une application web pour organiser les **domaines professionnels liés aux offres d'emploi**. L'interface d'administration permet actuellement de consulter les domaines enregistrés et d'en ajouter de nouveaux.

![Illustration d'une équipe travaillant sur un projet](https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80)

*Illustration : le travail d'équipe et la conception d'un projet numérique.*

## Objectif du projet

L'objectif est de proposer une interface simple pour centraliser les domaines professionnels et préparer le classement des offres d'emploi. Cette première version permet d'afficher et d'ajouter un domaine, avec son nom et sa description.

> **Périmètre actuel :** la gestion des domaines est fonctionnelle. ~~La gestion complète des offres d'emploi est déjà disponible~~ ; elle constitue une évolution possible du projet.

## Fonctionnalités et technologies

| Élément | Rôle | État |
| --- | --- | --- |
| Interface HTML et Tailwind CSS | Présenter les domaines et le formulaire d'ajout | Disponible |
| JavaScript et `fetch()` | Communiquer avec l'API sans recharger la page | Disponible |
| API PHP | Lister les domaines avec `GET` et en ajouter avec `POST` | Disponible |
| Fichier JSON | Stocker les domaines dans `backend/data/Domaines.json` | Disponible |
| Gestion complète des offres | Créer, modifier et suivre les offres | À développer |

### Technologies utilisées

- **PHP** avec une organisation orientée objet.
- **HTML5** et **Tailwind CSS** pour l'interface.
- **JavaScript** pour les échanges avec l'API.
- **JSON** pour le stockage des domaines.

## Parcours d'utilisation

1. L'administrateur ouvre la page de gestion des domaines.
2. L'application demande la liste des domaines à l'API.
3. Les domaines s'affichent dans un tableau.
4. L'administrateur remplit le formulaire pour ajouter un domaine.
5. L'application envoie les données à l'API et actualise la liste.

## Avancement

- [x] Afficher les domaines enregistrés.
- [x] Ajouter un domaine avec un nom et une description.
- [x] Stocker les données dans un fichier JSON.
- [ ] Ajouter la modification et la suppression des domaines.
- [ ] Développer la gestion des offres d'emploi.

## Structure du projet

```text
Projet Technique/
├── index.html
├── assets/
│   └── js/
│       └── app.js
└── backend/
    ├── api/
    │   └── api.php
    ├── classes/
    │   ├── Domaine.php
    │   └── GestionDomaine.php
    ├── controller/
    │   └── ControllerDomaine.php
    └── data/
        └── Domaines.json
```

## Lancer l'application

Depuis la racine du dépôt, placez-vous dans le dossier du projet puis démarrez le serveur PHP :

```bash
cd "Projet Technique"
php -S localhost:8000
```

Ouvrez ensuite [http://localhost:8000](http://localhost:8000) dans votre navigateur. L'application utilise PHP pour son API ; PHP doit donc être installé sur votre ordinateur.

## Liens utiles

- [Ouvrir la page de l'application](./Projet%20Technique/index.html)
- [Documentation PHP](https://www.php.net/manual/fr/)
- [Guide Markdown](https://www.markdownguide.org/)

## Exemple d'échange avec l'API

L'API située dans `backend/api/api.php` prend en charge les méthodes `GET` et `POST`. Voici un exemple de corps JSON pour ajouter un domaine :

```json
{
  "nom": "Informatique",
  "description": "Développement, réseaux et systèmes"
}
```

---

*Projet réalisé dans le cadre d'un apprentissage du développement web et de Markdown.*
