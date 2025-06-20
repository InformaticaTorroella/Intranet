# Intranet TM

A private intranet application built with Laravel for internal use by the Informatica Torroella team.

## 📋 Description

This project is a Laravel-based web platform designed to manage internal operations such as documents, schedules, announcements, and more for the Torroella de Montgrí IT department.

---

## 🚀 Installation

Follow these steps to set up the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/InformaticaTorroella/Intranet.git
cd Intranet
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure your database settings:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Serve the Application

```bash
php artisan serve
```

The app will be accessible at: [http://localhost:8000](http://localhost:8000)

---

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- Laravel CLI
- MySQL or compatible DB

---

## 📂 Project Structure

- `app/` – application logic
- `resources/views/` – Blade templates
- `routes/web.php` – route definitions
- `public/` – publicly accessible files
- `database/` – migrations, seeders

---

## 📌 Notes

- `.env` file is **not included**. Create and configure it as needed.
- `vendor/` and `node_modules/` directories are excluded from version control.

---

## 💪 Contributing

This is a private repo for internal use. For any suggestions or issues, please contact the maintainers directly.

---

## 📄 License

Proprietary – All rights reserved.
