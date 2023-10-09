# StayScape - A house Room Booking application

Welcome to StayScape, an innovative platform for booking and managing accommodations, designed to simplify the way you find and reserve your ideal stay.

## Table of Contents

- [Built With](#built-with)
- [About](#about)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Deployment](#deployment)
- [Usage](#usage)
- [Contributing](#contributing)


## Built With
List the technologies, frameworks, and libraries used to build your project.

- [Laravel](https://laravel.com/) - The PHP framework used
- [Bootstrap](https://getbootstrap.com/) - Frontend design framework
- [Javascript](https://en.wikipedia.org/wiki/JavaScript) - Frontend JavaScript
- [MySQL](https://www.mysql.com/) - Database management system
## About
StayScape is your go-to solution for hassle-free accommodation booking. Whether you're a traveler looking for the perfect place to stay or a property owner wanting to list your spaces, StayScape offers a seamless experience.

Key Highlights:
- User-friendly interface
- Diverse range of accommodations
- Secure and convenient booking process
- Host and guest profiles
- Real-time availability tracking
- Robust admin panel for property owners
- and much more!

## Features

### For Travelers:
- **User Registration and Authentication:** Create your account to start booking accommodations.
- **Search and Filter:** Find the ideal stay by filtering through various options such as location, price range, and amenities.
- **Booking Management:** Keep track of your reservations and booking history.
- **User Profile:** Customize your profile, add payment methods, and manage your preferences.

### For Property Owners:
- **Property Listing:** Easily list your accommodations with details, images, and pricing.
- **Booking Management:** Accept or reject booking requests, manage availability, and set pricing.
- **Profile Dashboard:** Access your host dashboard for performance analytics and earnings.
- **Instant Messaging:** Communicate with guests through our integrated messaging system.

## Getting Started

### Prerequisites

Before running StayScape, make sure you have the following installed:

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)

### Installation

1. Clone the StayScape repository to your local machine:

     Use the Git command to clone the StayScape repository to your local machine. This step downloads the project files.

   ```shell
   git clone https://github.com/myuvarajapandian/stayscape.git

2. Navigate to the project directory:

    Use the "cd" command to navigate into the project directory. This is where you'll work with the StayScape code.

    ```shell
    cd stayscape

3. Install PHP dependencies:

    Run Composer's composer "install command" to install the PHP packages and libraries required by StayScape. Composer will fetch and set up these dependencies.

    ```shell
    composer install

4. Set up your environment variables:

    Duplicate the provided ".env.example" file and name the copy ".env". This file will store your environment-specific configurations like database connection details and application settings.

    ```shell
    cp .env.example .env

5. Generate an application key:

    Use php "artisan key:generate" to generate a unique application key. This key is used for encrypting data in your application.

    ```shell
    php artisan key:generate

6. Create an empty MySQL database for StayScape and update the database configuration in your '.env' file.

    Set up your MySQL database for StayScape. You'll need to create an empty database and configure the connection details in the .env file.

7. Migrate the database:

    Run "php artisan migrate" to create the necessary database tables and schema for StayScape.

    ```shell
    php artisan migrate

8. Link storage

     Execute "php artisan storage:link" to create a symbolic link from the "public/storage" directory to the "storage/app/public" directory. This allows for the storage of user-uploaded files.

    ```shell
    php artisan storage:link

9. Start the development server:

    Launch the development server by running "php artisan serve". This starts a local web server, and you can access StayScape by visiting http://127.0.0.1 in your web browser.

    ```shell
    php artisan serve

10. Visit http://127.0.0.1 in your web browser to access StayScape.

These steps are essential to set up and run StayScape on your local environment for development and testing. Make sure to configure your .env file with appropriate values for your database and other settings.

## Usage
### Deployment
Instructions are provided to how to deploy your application to a production server or platform. Include any necessary configurations or environment variables below.

### Travelers: 

- Sign up or log in to search and book accommodations. 
- Manage your bookings and profile settings.

### Property Owners:

- Sign up as a host to list your accommodations, manage bookings, and track your earnings.

## Contributing
We welcome contributions from the community. If you'd like to contribute to StayScape, please follow these 

### guidelines:

- Fork the repository.
- Create a new branch for your feature or bug fix.
- Make your changes and submit a pull request.


