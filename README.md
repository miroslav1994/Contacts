
## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone -b branch_name url_repo

Switch to the repo folder

    cd contacts

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate


You can now access the server at http://localhost:8000 or virtual host like 'contacts.test'

## Usage

* Bootstrap 3.0.2
* Font-awesome 4.7.0
* CKEditor 4.14.0
* JQuery 1.9.1
* Knockout.js 3.5.1



