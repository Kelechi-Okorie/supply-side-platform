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

### Creating a symbolic link between storage/app/public and public/storage
While using Laradock symbolic links created in the project folde will always return 404 in the browser. To solve this problem, if you need to upload files to the backend and make it available publicly you will need to create the symbolic link in the laradock workspace. Following the steps below
- `docker-compose down`
- `docker-compose up`
- `docker ps` to get workspace container id
- `docker exec -it [workspace-container-id] bash`
- Run `php artisan storage:link` in the supply-side-platform directory. If it does not work, you can create it manually from the public    folder with `ln sf ../storage/app/public storage` 
[Read more about this on stackoverflow](https://stackoverflow.com/questions/64833653/laradock-404-not-found-files-with-symlink-to-storage)

### Running tests

To run test, run the comand `php artisan test`
