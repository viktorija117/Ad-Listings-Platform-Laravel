## KupujemProdajem Laravel Application
A Laravel-based classified ads platform with features for posting, managing ads, and a messaging system for communication between users.

## Features
- Authentication: Register, login, email verification, and password reset. 
- Role-based Permissions:
Admin: Manage categories, locations, and all ads.
User: Create, edit, and delete own ads, send messages related to ads.
- Ads:
Create and delete ads with images, categories, and locations.
Filter ads by category and location.
- Messaging:
Chat system tied to specific ads.
- Dashboard: Shortcuts for ads, messages, and admin tasks for admins.

## Installation
- Clone the repo:
git clone https://github.com/viktorija117/KupujemProdajem-Laravel
- Install dependencies:
composer install && npm install
npm run dev
Set up .env file:
cp .env.example .env
- Generate app key:
php artisan key:generate
- Run migrations:
php artisan migrate --seed
php artisan db:seed --class=RolesAndPermissionsSeeder
- Start the app:
php artisan serve
