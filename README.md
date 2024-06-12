# WellFish Backend API

Welcome to the WellFish Backend API! This API is developed using Laravel to support the WellFish project, which aims to enhance the efficiency and safety of marine product consumption by providing fish species identification and freshness detection via a mobile application.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Running Tests](#running-tests)
- [API Documentation](#api-documentation)

### Introduction

WellFish is an innovative solution designed to assist consumers, fishermen, traders, and other stakeholders in the marine industry. By leveraging machine learning, WellFish provides accurate fish species identification and disease detection, ensuring the freshness and safety of fish for consumption. This helps in reducing consumer uncertainties and protecting marine ecosystems from the spread of fish diseases.

### Features

- **Fish Species Identification**: Detect and identify different species of fish using machine learning.
- **Freshness Detection**: Determine the degree of freshness of the fish accurately.
- **Disease Detection**: Identify diseases in fish to prevent their spread and protect marine ecosystems.
- **User Management**: Support for various user roles including fishermen, traders, and general consumers.

### Requirements

- PHP >= 8.2
- Composer
- MySQL 8.0

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
      ```bash
    DB_CONNECTION=mysql
    DB_HOST=<your_db_host>
    DB_PORT=3306 # you can change this if your db is running on a different port
    DB_DATABASE=<your_db_name>
    DB_USERNAME=<your_db_username>
    DB_PASSWORD=<your_db_password>
    GOOGLE_CLOUD_STORAGE_BUCKET=<your_gogolecloud_bucket>
    GOOGLE_CLOUD_STORAGE_BUCKET_PUBLIC=<your_gogolecloud_bucket_public>
    GOOGLE_CLOUD_PROJECT_ID=<your_gogolecloud_project_id>

5. **Run the migrations**:
   ```bash
   php artisan migrate

6. **Import your google service account with google cloud storage permissions to root folder The Structure Will Look like this**:
   ```bash
    artisan 
    service-account.json
    composer.json
    composer.lock
   
7. **Start the development server**:
   ```bash
    php artisan serve

8. **You're all set!**:
    Your backend API is now up and running. You can access the API at `http://localhost:8000`.

### Running Tests
1. **Create database for testing**:
   ```bash
    CREATE DATABASE database_name_testing;
   
2. **Create .env.testing file**:
   ```bash
    cp .env.example .env.testing
    php artisan key:generate
   
3. **Configure the env**:
    ```bash
     APP_ENV=testing
     DB_CONNECTION=mysql
     DB_HOST=<your_db_host>
     DB_PORT=3306 # you can change this if your db is running on a different port
     DB_DATABASE=<your_db_name_testing>
     DB_USERNAME=<your_db_username>
     DB_PASSWORD=<your_db_password>
     GOOGLE_CLOUD_STORAGE_BUCKET=<your_gogolecloud_bucket>
     GOOGLE_CLOUD_STORAGE_BUCKET_PUBLIC=<your_gogolecloud_bucket_public>
     GOOGLE_CLOUD_PROJECT_ID=<your_gogolecloud_project_id>

4. **Run the tests**:
   ```bash
   php artisan test
   
5. **You're all set!**:
    Your tests are now running.

### API Documentation
The API documentation can be accessed at https://documenter.getpostman.com/view/19448005/2sA3XMhNgf

