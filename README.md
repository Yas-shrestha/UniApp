# University App

A web application built for [University Name].

---

## Requirements

- PHP >= 8.1
- Composer
- Node.js >= 18 & npm
- MySQL or PostgreSQL
- Git

---

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/your-org/uni-app.git
cd uni-app
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Configure environment

Copy the example env file and update the values:

```bash
cp .env.example .env
```

Open `.env` and set your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uni_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Run database migrations

```bash
php artisan migrate
```

Optionally seed the database with sample data:

```bash
php artisan db:seed
```

### 7. Build frontend assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 8. Start the development server

```bash
php artisan serve
```

The app will be available at `http://localhost:8000`.

---

## Running Tests

```bash
php artisan test
```

---

## Troubleshooting

- **Composer not found** — install from [getcomposer.org](https://getcomposer.org)
- **Permission errors on storage/bootstrap/cache** — run `chmod -R 775 storage bootstrap/cache`
- **Migrations failing** — make sure your database exists and credentials in `.env` are correct
