# Cudomisie
Laravel 5.4 + some Javascript/jQuery e-commerce website.

## 1. Features
Description comming soon

## 2. Todo
- More tests
- Code refactoring
- Extend dropzone with drag and drop
- Navigation CRUD with drag and drop

## 3. Tests
I've written a couple of browser tests using Laravel Dusk. To run them type:<br />
`php artisan dusk`

To run single test you need to provide it's full path:<br />
`php artisan dusk tests\browser\OrderTest.php`

I'm planning to add more tests soon, using pure PHPUnit as well (Dusk is pretty slow ATM).

## 4. Installation
*Install Composer and Node.js if you don't have it. You will also need HTTP and MySQL server (I recommend Laravel Homestead, or XAMPP).*

- Clone repository:<br />
`git clone https://github.com/bogumilkorek`

- Go into created directory:<br />
`cd cudomisie`

- Rename .env.example to .env and insert your data

- Install Composer dependencies :<br />
`composer install`

- Install Node.js dependencies:<br />
`npm install`

- Run your HTTP/MySQL server:<br />
`vagrant up` or start XAMPP and copy cudomisie directory into XAMPP's htdocs, or start XAMPP's MySQL server and start PHP's default server `php artisan serve`

- Create new database using one of above tools

- Run DB migrations:<br />
`php artisan migrate`

- If you want to fill DB with example values:<br />
`php artisan db:seed`

- Compile, join and minify SASS and Javascript assets:<br />
`npm run dev`

- Run queue via schedule (or change QUEUE_DRIVER=database to QUEUE_DRIVER=sync in your .env file):<br />
`php artisan schedule:run`

- Run tests:<br />
`php artisan dusk`
