# GetWebArab — Partner & Admin Dashboard

This is the v1 management-only dashboard for GetWebArab. It tracks clients, computes founder-discount statuses and partner splits, and displays partner earnings.

## Requirements
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB

## Installation

1. **Clone & Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration:**
   Copy the example environment file and configure your database:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Ensure your `.env` contains the correct database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=getwebarab_dashboard
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Database Setup & Seeding:**
   Run the migrations and seed the database with required settings, services, and demo accounts:
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Build Frontend Assets:**
   ```bash
   npm run build
   ```

5. **Run the Application:**
   ```bash
   php artisan serve
   ```

## Demo Accounts

The database seeder provisions the following accounts:

- **Admin Account**
  - Email: `admin@getwebarab.com`
  - Password: `password`
- **Partner Account 1**
  - Email: `partner1@example.com`
  - Password: `password`
- **Partner Account 2**
  - Email: `partner2@example.com`
  - Password: `password`

## Core Concepts

- **Partner**: A trusted person who closes clients.
- **Client**: A business managed by a partner.
- **Founder Discount**: A 25% discount automatically applied to a partner's first 5 clients.
- **Split**: 40% of setup fee + 25% of recurring monthly fees go to the partner; the rest is retained by the house.
- **Services**: Include Website Care (mandatory), SEO, Ads, and Email.

## Key Services
- `PricingService`: Handles the complex logic of splitting the costs and applying the founder discounts.
- `ReferralService`: Responsible for determining client attribution and checking the active founder cap.
