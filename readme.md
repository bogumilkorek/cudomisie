# Cudomisie
Laravel 5.4 + some Javascript/jQuery e-commerce website.

## 1. Features
- CRUD for pages, blog posts, products, categories, shipping methods
- App can be easily translated to desired language using translation strings. Just rename `resources/lang/pl.json` to your language and translate it. If you need English language only just delete this file.
- Shopping cart
- Search system (products, pages, blog posts)
- Send SMS when order is shipped using NEXMO
- Create PDF (invoices)
- Check if products are still available before order
- Buy without login or login with standard Laravel auth
- Login with Google/Facebook/Twitter using Laravel Socialite
- User: update profile, and view order history
- Image dropzone
- WYSIWYG (CKEditor) including file manager with image upload

## 2. Structure
- Database migrations and seeders: description comming soon
- View composers
  - LatestProductComposer: description comming soon
  - CategoryComposer: description comming soon
  - CartItemsComposer: description comming soon
- Traits: description comming soon
- Schedule: description comming soon
- Listeners: description comming soon
- Events: description comming soon
- Notifications: description comming soon
- Mail: description comming soon
- App service provider: description comming soon
- Auth: description comming soon
- Blade components: description comming soon
- Laravel Mix: description comming soon

## 3. Todo
- More tests
- Code refactoring
- Extend dropzone with drag and drop
- Navigation CRUD with drag and drop
- AJAX Duplicate check on title field focus out

## 4. Tests
I've written a couple of browser tests using Laravel Dusk. To run them type:<br />
`php artisan dusk`

To run single test you need to provide it's full path:<br />
`php artisan dusk tests\browser\OrderTest.php`

I'm planning to add more tests soon, using pure PHPUnit as well (Dusk is pretty slow ATM).

## 5. Dependencies
### 1. Composer
- *barryvdh/laravel-debugbar*: debug bar useful for development, it appears at the bottom of page
- *barryvdh/laravel-dompdf*: create PDF's for invoices
- *laravel/dusk*: create browser tests
- *laravel/socialite*: login via google/facebook/twitter
- *nexmo/laravel*: send SMS when order is shipped
- *unisharp/laravel-filemanager*: useful filemanager added to WYSIWYG
- *uxweb/sweet-alert*: nice looking messages
- *webpatser/laravel-uuid*: create UUID for orders

### 2. Node.js
- *baguettebox.js*: image gallery
- *ckeditor*: WYSIWYG
- *datatables.net*: additional table features (e.g. search, sort, paginate)
- *dropzone*: drag and drop image container
- *font-awesome*: icons
- *imagemin-webpack-plugin*: webpack plugin for image optimization
- *jquery-match-height*: same height for product grid
- *jquery.easing*: advanced easing options
- *select2*: advanced select/multiselect tool
- *smartmenus*: multi level dropdown menu

## 6. Installation
*Install Composer and Node.js if you don't have it. You will also need HTTP and MySQL server (I recommend Laravel Homestead, or XAMPP).*

- Clone repository:<br />
`git clone https://github.com/bogumilkorek`

- Go into created directory:<br />
`cd cudomisie`

- Rename .env.example to .env and insert your data

- Generate app key:<br />
`php artisan key:generate`

- Install Composer dependencies:<br />
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

## 7. License
This app is free for personal and commercial use.<br /><br />
Feel free to ask me any questions.<br /><br />
**Code reviews are always much appreciated :)**
