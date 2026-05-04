<div align="center">

# LPM Campus CMS

**A role-based Content Management System for LPM Universitas Gunung Kidul**

Built with Laravel · PHP 8 · MySQL · Blade · Bootstrap

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)](LICENSE)

[Live Demo](http://lpm.ugk.ac.id/) · [Report Bug](https://github.com/Yefta2404-Ind/lpm-campus-cms/issues) · [Request Feature](https://github.com/Yefta2404-Ind/lpm-campus-cms/issues)

</div>

---

## Overview

LPM Campus CMS is a web-based content management system built for the Quality Assurance unit (LPM) of Universitas Gunung Kidul. It enables administrators and staff to manage website content — news, gallery, pages, menus, and organizational structure — through a structured, role-controlled workflow without direct server or code access.

> This project shares the same codebase architecture as [LPMI Campus CMS](https://github.com/Yefta2404-Ind/lpmi-campus-cms), adapted and deployed independently for LPM.

---

## Features

- **Role-Based Access Control** — Three distinct roles (Admin, Staff, Public) with policy-level enforcement
- **News Approval Workflow** — Staff submits content, Admin reviews and publishes; nothing goes live without approval
- **Dynamic Page & Menu Builder** — Create and manage static pages and navigation menus from the dashboard
- **Organization Structure Manager** — Maintain and display the institutional org chart dynamically
- **Gallery Management** — Upload and organize event photos tied to published content
- **Responsive UI** — Mobile-friendly interface for both admin panel and public-facing site

---

## Architecture

### Stack

| Layer | Technology |
|---|---|
| Backend Framework | Laravel 10.x (MVC) |
| Language | PHP 8.1 |
| Templating | Blade |
| Styling | Bootstrap 5 / Tailwind CSS |
| Database | MySQL |
| Auth | Laravel built-in Auth |

### Application Flow

```
Browser Request
      │
      ▼
 Laravel Router (routes/web.php)
      │
      ├── Middleware (Authenticate, CheckRole)
      │
      ▼
 Controller Layer
  ├── AuthController
  ├── NewsController        ← submit / approve / publish
  ├── GalleryController
  ├── MenuController
  ├── PageController
  └── OrgStructureController
      │
      ▼
 Eloquent ORM (Models)
  ├── User          (with roles)
  ├── News          (status: draft | pending | published)
  ├── Gallery
  ├── Menu
  ├── Page
  └── OrgStructure
      │
      ▼
   MySQL Database
      │
      ├── Blade Views (Admin Panel)
      └── Blade Views (Public Site)
```

### Role Access Matrix

| Feature | Admin | Staff | Public |
|---|:-:|:-:|:-:|
| View published content | ✓ | ✓ | ✓ |
| Submit news / announcements | ✓ | ✓ | — |
| Approve & publish content | ✓ | — | — |
| Manage menus & pages | ✓ | — | — |
| Manage organization structure | ✓ | — | — |
| Manage gallery | ✓ | ✓ | — |
| User & role management | ✓ | — | — |

### Database Schema (ERD Overview)

```
users ──────────────── roles
  │                      │
  │ (has role)           │ (defines permission)
  │                      │
  ├──< news             ─┘
  │      ├── status: draft | pending | published
  │      └── approved_by → users.id (FK)
  │
  ├──< gallery
  │
  ├──< org_structures
  │      └── parent_id (self-referential, for hierarchy)
  │
  ├──< menus
  │      └── page_id (FK → pages)
  │
  └──< pages
```

> Full ERD diagram available in `/docs/erd.png` *(coming soon)*

---

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL
- Node.js *(optional, for asset compilation)*

### Installation

```bash
git clone https://github.com/Yefta2404-Ind/lpm-campus-cms.git
cd lpm-campus-cms

composer install

cp .env.example .env
php artisan key:generate

# Configure DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env
php artisan migrate

php artisan serve
```

Visit `http://localhost:8000`

---

## Related Projects

| Project | Description | Live |
|---|---|---|
| [LPMI Campus CMS](https://github.com/Yefta2404-Ind/lpmi-campus-cms) | CMS for LPMI Universitas Gunung Kidul | [lpmi.ugk.ac.id](http://lpmi.ugk.ac.id/) |
| LPM Campus CMS | CMS for LPM Universitas Gunung Kidul | [lpm.ugk.ac.id](http://lpm.ugk.ac.id/) |

---

## Author

**Yefta Aditya**
[github.com/Yefta2404-Ind](https://github.com/Yefta2404-Ind)
