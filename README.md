# Backend API

## Overview

Welcome to the WellFish Backend API repository! This project is a robust and scalable backend solution built with Laravel. It is designed to provide a clean and intuitive API interface, secure authentication, and seamless database management.

## Features

- **RESTful API**: Follows REST principles for a clean API design.
- **Database Management**: Seamless integration with MySQL or other databases supported by Laravel.
- **Validation**: Built-in request validation to ensure data integrity.
- **Error Handling**: Comprehensive error handling and logging.
- **Scalability**: Designed to handle high traffic and scale horizontally.
- **Documentation**: API documentation using tools like Postman.

## Technologies Used

- **Laravel**: PHP framework for web applications.
- **Database**: MySQL.
- **Validation**: Laravel's built-in validation.
- **Documentation**: Postman for API documentation.

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/WF-WellFish/backend-api.git
   cd backend-api

2. **Install dependencies**:
   ```bash
   composer install

3. **Set up environment variables**:
   ```bash
    cp .env.example .env
    php artisan key:generate

4. **configure the env**

5. **Run the migrations**:
   ```bash
   php artisan migrate

6. **Start the development server**:
   ```bash
    php artisan serve

7. **You're all set!**:
    Your backend API is now up and running. You can access the API at `http://localhost:8000`.

## API Documentation
The API documentation can be accessed at https://www.postman.com/gold-rocket-493207/workspace/wellfish-workspaces

