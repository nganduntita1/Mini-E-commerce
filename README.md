# Mini E-Commerce Application

This is a mini e-commerce application built with Laravel and Vue.js. It allows users to browse products, filter them by categories, add them to a shopping cart, and manage the cart. The application also includes a scheduled job for cart clean-up.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Setup Instructions](#setup-instructions)
- [Assumptions](#assumptions)
- [Usage](#usage)


## Features

- User authentication
- Product listing with category filtering
- Add products to the cart
- Remove products from the cart
- Update product quantities in the cart
- Scheduled cart clean-up job

## Technologies Used

- **Backend**: Laravel, Breeze
- **Frontend**: Vue.js, Inertia.js
- **Database**: MySQL
- **Package Manager**: Composer, npm

## Setup Instructions

To set up and run the project locally, follow these steps:

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/nganduntita1/Mini-E-commerce.git
    cd Mini-E-commerce
    ```

2. **Install Backend Dependencies**:
    ```bash
    composer install
    ```

3. **Set Up Environment Variables**:
   - Copy the example environment file and edit it:
    ```bash
    cp .env.example .env
    ```
   - Configure your database connection and other settings in the `.env` file.

4. **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

5. **Run Database Migrations**:
    ```bash
    php artisan migrate
    ```

6. **Seed the Database**:
    - Run the database seeder to populate categories and products:
    ```bash
    php artisan db:seed
    ```

7. **Install Frontend Dependencies**:
    ```bash
    npm install
    ```

8. **Compile Frontend Assets**:
    ```bash
    npm run dev
    ```

9. **Run the Application**:
   - Start Laravel Herd and access the application URL provided by Herd (usually something like `http://myapp.test`).

10. **Access the Application**:
   - Open your browser and navigate to the URL provided by Laravel Herd.

## Assumptions

- You have PHP, Composer, Node.js, and npm installed on your machine.
- You are using SQLite/MySQL as your database.
- You are using Laravel Herd for local development.

## Usage

- Log in or register a new account to access the product listing.
- Use the category filter to narrow down products.
- Adjust the quantity of a product before adding it to the cart.
- View your cart to manage items.
- The cart will automatically clean up stagnant items every 30 days.


