# StayScape - Your Project Name

Welcome to StayScape, an innovative platform for booking and managing accommodations, designed to simplify the way you find and reserve your ideal stay.

## Table of Contents

- [About](#about)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)


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

   ```shell
   git clone https://github.com/myuvarajapandian/stayscape.git

2. Navigate to the project directory:

    ```shell
    cd stayscape

3. Install PHP dependencies:

    ```shell
    composer install

4. Create a '.env' file by copying '.env.example' and set up your environment variables:

    ```shell
    cp .env.example .env

5. Generate an application key:

    ```shell
    php artisan key:generate

6. Create an empty MySQL database for StayScape and update the database configuration in your '.env' file.

7. Migrate the database:

    ```shell
    php artisan migrate

8. Start the development server:

    ```shell
    php artisan serve

9. Visit http://localhost:8000 in your web browser to access StayScape.


## Usage

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

