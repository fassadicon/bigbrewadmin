
# Point-of-Sale and Inventory System

POS and Inventory System for Big Brew Bayan Bayanan. Features include the generation and management of Products, Suppliers, Orders, Purchase Orders, Delivery Receiving, Employees, and Inventory. 


## Technologies used

 - PHP 8.2
 - [Laravel 10](https://laravel.com/)
 - [Livewire 3](https://livewire.laravel.com/)
 - [Alpine JS](https://alpinejs.dev/)
 - [Laravel Breeze](https://github.com/laravel/breeze)
 - [Laravel Excel](https://laravel-excel.com/)
 - [Laravel DOMPDF](https://github.com/barryvdh/laravel-dompdf)
 - [Livewire Toaster](https://github.com/masmerise/livewire-toaster)
 - [Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction)
 - [Laravel Activity Log](https://spatie.be/docs/laravel-activitylog/v4/introduction)
 - [Eager Load Pivot Relations](https://github.com/ajcastro/eager-load-pivot-relations)  
## Run Locally

Clone the project

```bash
  git clone https://github.com/fassadicon/bigbrewadmin.git
```

Install composer dependencies

```bash
  composer install
```

Generate .env

```bash
  cp .env.example .env
```

Generate app key

```bash
  php artisan key:generate
```

Install npm dependencies

```bash
  npm install
  npm run build
```

Migrate the database

```bash
  php artisan migrate:fresh --seed
```

Start the server

```bash
  php artisan serve
```

