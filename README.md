![Multi-Canteen Management System Poster](C:\Users\Gayan Sampath\.gemini\antigravity\brain\6880df94-9396-4660-97b2-75639b920bcb\multi_canteen_poster_1781865371982.png)

# Multi-Canteen Management System

A comprehensive web application built with Laravel to streamline food ordering and management for multiple canteens within an institution or campus. The system provides dedicated interfaces for Students, Canteen Owners, and Administrators.

## 🚀 Key Features

### 🎓 Student (Customer) Portal
- **Browse Canteens & Menus**: View available canteens and their daily menus.
- **Place Orders**: Order meals and track order status in real-time.
- **Favorites**: Save favorite canteens for quick access.
- **Reviews & Ratings**: Leave reviews and ratings for canteens.
- **Notifications**: Receive updates on order status and other alerts.

### 🏪 Canteen Owner Portal
- **Menu Management**: Add, update, and manage daily menus (including meal types, curries, and food photos).
- **Order Management**: View incoming orders, update order statuses (e.g., pending, preparing, ready, delivered), and manage payment statuses.
- **Dashboard**: Track daily sales, active orders, and overall canteen performance.

### 🛡️ Administrator Portal
- **Canteen Management**: Register and manage all canteens operating within the system.
- **User Management**: Oversee all users, including students, canteen staff, and other admins.
- **System Overview**: Access platform-wide statistics, metrics, and monitor all orders across canteens.

## 🛠️ Tech Stack

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Tailwind CSS, Alpine.js, Blade Templates
- **Asset Bundling**: Vite
- **Database**: MySQL / SQLite (Laravel supported databases)

## ⚙️ Prerequisites

Before you begin, ensure you have the following installed on your local environment:
- PHP >= 8.2
- Composer
- Node.js & npm
- Database engine (MySQL, PostgreSQL, or SQLite)

## 🛠️ Installation & Setup

Follow these steps to get your development environment running:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Dewmithathsarani/MultiCanteenManagementSystem.git
   cd MultiCanteenManagementSystem
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   Copy the example environment file and generate a new application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure the Database:**
   Open the newly created `.env` file and update your database credentials. 
   *(Note: For a quick local setup, you can set `DB_CONNECTION=sqlite` and run the migrations, which will automatically create the `database.sqlite` file.)*

6. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate --seed
   ```

7. **Compile Frontend Assets:**
   ```bash
   npm run build
   # Or for hot-module replacement during development:
   # npm run dev
   ```

8. **Start the Development Server:**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

## 📜 License

This project is built using the Laravel framework, which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
