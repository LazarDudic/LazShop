<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


##  LazShop

Installation: 

- Clone project from Git.
```bash
git clone https://github.com/Lazar90/LazShop.git
```

- Move terminal to project location.
```bash
cd LazShop
```
- Create and Set up your .env file by copying .env.example file.
    * Fill in a database, email and stripe information.
    
- Install dependencies.
```bash
composer install
```

-  Generate the application key.
```bash
php artisan key:generate
``````

- Run migration 
```bash
php artisan migrate
``````

- Add fake data.
```bash
php artisan db:seed
``````

- Run local development server.

```bash
php artisan serve
``````
- Run the queue worker 

```bash
php artisan queue:work
````````````

- Log in as an admin
    * email: admin@admin.com
    * password: password
     
