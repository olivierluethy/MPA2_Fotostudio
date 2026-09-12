<div align="center">
  <img src="assets/icon.png" alt="Fotostudio logo" width="140" />
  <h1>Fotostudio</h1>
  <p><b>A photo library web app for a photography studio.</b><br/>Upload, describe and manage photos with per-image metadata and visibility, a public gallery, and user administration.</p>
  <p>
    <a href="LICENSE"><img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-blue.svg"></a>
    <img alt="PHP" src="https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white">
    <img alt="MySQL" src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white">
    <img alt="Docker" src="https://img.shields.io/badge/Docker-2496ED?logo=docker&logoColor=white">
    <img alt="JavaScript" src="https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black">
  </p>
</div>

---

Fotostudio is a web application for a photographer who wants to store and manage
all their photos — both studio and private — in one place. Signed-in users upload
images and capture a title, an optional description, a date, a location and whether
the photo should be publicly visible. Visitors who are not logged in only see the
public gallery on the start page; private photos stay private. Signed-in users can
browse every photo and manage the studio's user accounts. The whole interface is
responsive and copes with any image size.

Built as a "Mini PA" apprenticeship project on a hand-rolled PHP MVC structure.

## Features

- **Upload photos** with metadata: title, optional description, date, location and a public/private flag.
- **Public gallery** on the start page for visitors; the full library is visible only when signed in.
- **Edit and delete** existing photos, including an in-place edit modal.
- **User management** — list, add, edit and remove studio user accounts.
- **Authentication** with hashed passwords (PHP `password_hash` / `password_verify`).
- **Location autocomplete** and client-side form validation.
- **Responsive layout** that adapts to every image size.

## Tech stack

- PHP on a custom MVC structure (`core/Router.php`, `core/bootstrap.php`, `app/Controllers`, `app/Models`, `app/Views`)
- MySQL 8 (schema in `Fotostudio.sql`)
- Apache with `.htaccess` URL rewriting
- Vanilla JavaScript (`public/js/`) for validation, autocomplete and UI
- Docker / Docker Compose (PHP-Apache + MySQL + phpMyAdmin)

## Getting started (Docker)

Requires Docker + Docker Compose. From the project root:

```bash
docker compose up --build        # add -d to run in the background
```

The first start builds the image, initialises the database and seeds mock data
(8 users + 24 photos) automatically. Then open:

| Service      | URL                    | Access                                              |
|--------------|------------------------|-----------------------------------------------------|
| **Web app**  | http://localhost:8800  | see login below                                     |
| **phpMyAdmin** | http://localhost:8801 | server `db`, user `root`, empty password (auto-login) |
| MySQL        | `localhost:3400`       | user `root`, no password (for external tools)       |

All mock users share the password **`fotostudio`** and sign in with their email
address (e.g. `admin@fotostudio.test`). Ports can be adjusted in
`docker-compose.yml`. See [`DOCKER.md`](DOCKER.md) for the full list of accounts
and commands.

## Project structure

```
index.php            Front controller + route table
core/                Router, bootstrap, database, helpers
app/Controllers/     BilderController, BenutzerController, LoginController
app/Models/          Bilder, Benutzer (DB access)
app/Views/           HTML views (gallery, upload/edit, user admin, login)
public/js/           Client-side validation, autocomplete and UI scripts
docker/              Dockerfile, Apache config, init/seed SQL
Fotostudio.sql       Database schema
```

## License

Released under the [MIT License](LICENSE) © 2026 Olivier Lüthy. You're free to use, modify and distribute this
software, including commercially, as long as the copyright notice and license are included.

## Author

Built by **Olivier Lüthy** — [GitHub](https://github.com/olivierluethy).
