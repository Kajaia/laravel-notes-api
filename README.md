# Google Keep Clone

## About

This is a basic Google Keep Clone made with Bootstrap, React, Laravel and MySQL. Stack is big but we wanted to create something really functional.

## Installation

1. Clone this repository `git clone git@github.com:Kajaia/google-keep-clone.git`
2. Go to downloaded folder `cd google-keep-clone` and open with your text editor `Ex: code .`
3. Change environment file - in windows: `copy .env.example .env`, in linux: `cp .env.example .env`
4. Install all your dependencies by running `composer install`
5. Generate key for your application `php artisan key:generate`
6. Run migration `php artisan migrate`
7. Seed dummy data `php artisan db:seed`
8. Go live by running `php artisan serve` and visit `127.0.0.1:8000`

### For node modules

1. Run command `npm install`
2. For development environment run `npm run dev`, for production `npm run prod`
