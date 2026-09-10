# QR Menu Task Admin | VioletPro

A Laravel-powered digital menu system for restaurants and cafés. Customers get to view a clean, responsive menu organized by category, while staff manage everything — categories, items, images, and availability — through a lightweight admin dashboard.

## Features

- **Public menu page** — categories and items rendered in a card grid on larger screens and a compact list on mobile, with smooth-scroll anchor navigation between categories.
- **Admin dashboard** — at-a-glance stats (total/active categories, total/active items) plus a table of recently added items.
- **Category management** — create, edit, and toggle categories active/inactive; categories with existing items are protected from deletion to avoid breaking the menu.
- **Item management** — full CRUD for menu items, including price, description, and image uploads.
- **Authentication** — admin routes are protected via Laravel UI; only logged-in staff can access the dashboard, categories, and items management pages.
- **Light/dark theme toggle** — persisted in the browser via `localStorage`, built with daisyUI's theme system.
- **Responsive navigation** — collapses into a dropdown menu on small screens and expands into a horizontal nav on larger screens.
- **Sortable/searchable admin tables** — powered by DataTables for quick lookups as the menu grows.

## Tech Stack

- **Backend:** Laravel
- **Auth:** Laravel UI
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS, daisyUI
- **Tables:** DataTables

## Installation

```bash
# Clone the repository
git clone https://github.com/Mustafa21102005/QR-Menu-Task-Admin-VioletPro.git
cd qr-menu-task-admin

# Install PHP dependencies
composer install

# Copy and configure environment
cp .env.example .env
php artisan key:generate
```

Update your `.env` with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=menu
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
# Run migrations and seed demo data
php artisan migrate --seed

# Link the storage folder for image uploads
php artisan storage:link

# Serve the app
php artisan serve
```

Visit `http://localhost:8000` to view the public menu, or visit `http://localhost:8000/login` in order to login and access the admin dashboard at `/dashboard`.

## Usage

1. **Log in** as an admin (created via the seeder).
2. Go to **Categories** to add the sections of your menu (e.g. Appetizers, Main, Drinks, Desserts).
3. Go to **Items** to add dishes under each category, including price, description, and an image.
4. Toggle categories or items **active/inactive** to control what appears on the public menu without deleting anything.
5. Visitors browsing the public menu will see only active categories and items.

## License

This project is open-sourced under the [MIT License](LICENSE).

## Author

**Mustafa Azmi Khalil** — © 2026
