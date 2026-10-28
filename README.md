# Projet Technique — Gestion des offres

Application web de gestion d'offres d'emploi : **PHP (POO) + JSON + API + AJAX**

> Actuellement : gestion des domaines (affichage en tableau)

## Technologies

- PHP (POO) — classes et API
- HTML5 / Tailwind CSS (CDN) — interface
- JavaScript + `fetch()` — AJAX
- JSON — stockage des données

## Structure

```text
Projet-Technique/
├── index.html                    # page admin (Tailwind) : Domaines
├── assets/
│   └── js/
│       └── app.js                # tout le fetch() (AJAX)
└── backend/
    ├── api/
    │   └── api.php               # API des domaines (GET / POST)
    ├── classes/
    │   ├── Domaine.php           # classe Domaine
    │   └── GestionDomaine.php    # gestion des domaines (JSON)
    ├── controller/
    │   └── ControllerDomaine.php # contrôleur des domaines
    └── data/
        └── Domaines.json
```

## Lancement

```bash
php -S localhost:8000
```

Puis ouvrir http://localhost:8000
