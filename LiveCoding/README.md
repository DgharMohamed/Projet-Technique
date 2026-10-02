# Projet Technique — Gestion des offres

Application web de gestion d'offres d'emploi : **PHP (POO) + JSON + API + AJAX**
## Technologies

- PHP (POO) — classes et API
- HTML5 / Tailwind CSS (CDN) — interface
- JavaScript + `fetch()` — AJAX
- JSON — stockage des données

## Structure

```text
Projet-Technique/
├── backend/
│   ├── api/
│   │   ├── GestionOffre.php      # API des offres (GET / POST)
│   │   └── GestionDomaine.php    # API des domaines (GET / POST)
│   ├── classes.php               # classes Domaine + Offre (un seul fichier)
│   └── database/
│       ├── offres.json
│       └── domaines.json
└── frontend/
    ├── index.html                # une seule page (Tailwind)
    └── index.js                  # tout le fetch()
```
