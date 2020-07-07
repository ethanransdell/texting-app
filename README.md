# Texting App
Ethan Ransdell - [Portfolio](http://ethanransdell.com) - [LinkedIn](https://www.linkedin.com/in/EthanRansdell)

## About

This application showcases pieces these particular features:

- System architecture (with the help of [Laradock](https://laradock.io/))
    - Linux
    - Nginx
    - MySQL
    - PHP
- Database
    - Schema design
    - Migrations
    - Models
    - Model factories for testing
- Third-party integrations (test messaging)
    - Modular package design that can be reused between apps
    - Twilio driver - *more to come*
    - Service provider structure allows testing with mock objects
- Vue.js
    - Components
    - Events
    - AJAX
    - Data orchestration
- Testing
    - Using mocked services
    - Vue.js testing - *coming soon*

## Setup

- Install [Docker](https://docs.docker.com/get-docker)
- Sign up for a [Twilio account](https://www.twilio.com/try-twilio)
- Clone this repository and set up the environment
    - `git clone --recurse-submodules git@github.com:ethanransdell/texting-app.git`
    - `cd texting-app`
    - `cp .env.example .env`
    - Fill in these Twilio credentials from your [account settings page](https://www.twilio.com/console/account/settings)
        - `TWILIO_SID`
        - `TWILIO_TOKEN`
- Launch Laradock
    - `cd laradock`
    - `cp env-example .env`
    - `docker-compose up -d mysql nginx`
    - Log into the MySQL instance at 127.0.0.1 and create a database called `texting_app`
- Enter the Laradock workspace
    - `docker-compose exec workspace bash`
    - `composer install`
    - `npm install`
    - `php artisan key:generate`
    - `npm run dev`

## License

Texting App is licensed under the [GNU General Public License](https://www.gnu.org/licenses/gpl-3.0.txt).
