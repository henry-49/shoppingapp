
# ShoppingApp Readme

Shoppingapp is a web application built on laravel framework with option to 
export orders in a PDF format.

## Clone and Setup Instructions

Welcome to the ShoppingApp project! Follow these steps to set up the project on your local machine:

## Step 1: Clone the Repository

Clone the project repository from GitHub using the following command:

```bash
  git clone https://github.com/henry-49/shoppingapp.git
```
## Step 2: Install Dependencies

Navigate to the project directory and install PHP dependencies using Composer:

```bash
  cd shoppingapp
  composer install
```
## Step 3: Configure Environment Variables

Make a copy of the .env.example file and rename it to .env. Update the necessary environment variables such as database credentials, app URL, etc.


```bash
  cp .env.example .env
```

## Step 4: Generate Application Key

Generate a new application key which is used for encryption, session management, etc.

```bash
  php artisan key:generate
```
## Step 5: Run Database Migrations

Run the database migrations to create the required tables in the database:

```bash
  php artisan migrate
```
## Step 6: Install Node.js Dependencies

 Using npm or yarn, install the dependencies:

 ```bash
  npm install
```
or 

```bash
  yarn install
```
## Step 7: Compile Frontend Assets

compile them:

 ```bash
  npm run dev
```
or 

```bash
  yarn dev
```
## Step 8: Serve the Application

You can serve the application using the built-in PHP development server:

```bash
  php artisan serve
```


By default, the application will be accessible at http://localhost:8000.

## Step 9: Visit the Application

Open your web browser and visit the URL where the application is served (http://localhost:8000 by default). You should see the ShoppingApp up and running.

## TODO: Integrate PayPal | Stripe  Payments and Send Email Notification

Integrate PayPal and Stripe payment gateways into the project.
