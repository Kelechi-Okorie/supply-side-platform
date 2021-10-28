<h3 align="center"><a href="" target="_blank">Eskimi Supply Side Platform</h3>

### How the environment should be set up

- You must have `Docker`, PHP, and `Composer` installed on your system
- Clone the repository
- cd into the supply-side-platform directory
- Enter laradock folder and `copy .env.example to .env`
- Run the command `docker-compose up -d nginx mysql phpmyadmin redis workspace`
- Go back to the project folder
- `Copy .env.example to .env`
- Open `.env` and set the following 
    - `DB_HOST=mysql`
    - `REDIS_HOST=redis`
    - `QUEUE_HOST=beanstalkd`
    - `DB_DATABASE=eskimi_db` - This assumes that you have created a database called eskimi_db with phpmyadmin

- To run migrations
    - Change DB_HOST from `mysql` to `127.0.0.1`
    - After running migrations change DB_HOST back to `mysql`

- To run database seeders
    - Change DB_HOST from `mysql` to `127.0.0.1`
    - AFter running the seeders change DB_HOST back to `mysql`

- Run `composer install`
- Open your browser and visit `http://localhost`  

### Running tests

To run test, run the comand `php artisan test`
