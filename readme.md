# Laravel Send Bulk SMS Web Project

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction

This project demonstrates a feature I added to a laravel backend project I worked on. This is a web application built with Laravel that allows users to send bulk sms to phonenumbers in an excel sheet and can be customised for similar projects.


## Installation

- Clone this repository to your local machine:
  ```bash
     git clone https://github.com/cgardesey/bulk_sms.git
- Navigate to the project directory:
   ```bash
      cd applications
- Create a .env file:
   ```bash
      cp .env.example .env
- Generate the application key:
   ```bash
      php artisan key:generate
- Set up your database credentials in the .env file:
   ```bash
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=your_database_username
      DB_PASSWORD=your_database_password
- Install the dependencies:
   ```bash
      composer install
- Run the database migration:
   ```bash
      php artisan migrate

You should now be able to access the application at `http://localhost:8000`.


## Usage

Follow the following steps to send bulk sms

- Copy the sms recepient numbers into the first column of the excel sheet located at the root of the public directory
- Visit http://127.0.0.1:8000/import-phone-numbers in your web browser or make a get request with a REST client like [Postman](https://www.postman.com/product/rest-client/) to bulk send sms to the phone numbers in the excel sheet

## Deployment

To deploy this application to a production server, follow these steps:
- Set up a production-ready web server (e.g., Nginx, Apache).
- Configure your web server to point to the public directory.
- Update the .env file with production-specific settings.
- Ensure your server meets the PHP and database requirements.
  
## Contributing

I welcome contributions to enhance the this bulk sms application. If you find any bugs or have feature suggestions, please open an issue or submit a pull request. Make sure to follow the existing coding style and conventions.


## License
This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).

## Contact

If you have any questions or need assistance, please contact me at cyrilgardesey@gmail.com.

Happy coding!

   

