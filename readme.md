# Cudomisie
Laravel 5.4 + some Javascript/jQuery e-commerce website.

## 1. Features
- CRUD for pages, blog posts, products, categories with subcategories, shipping methods
- App can be easily translated to desired language using translation strings. Just rename *resources/lang/pl.json* to your language and translate it. If you need English language only just delete this file.
- Shopping cart
- Search system (products, pages, blog posts)
- Send Markdown e-mails (order status change, order confirmation, contact form)
- Send SMS (order shipped) using NEXMO
- Create PDF (invoices)
- Check if products are still available before order
- Buy without login or login with standard Laravel auth
- Login with Google/Facebook/Twitter using Laravel Socialite
- User: update profile, and view order history
- Image dropzone
- Image is automacitally resized and thumbnail is created after upload
- WYSIWYG (CKEditor) including file manager with image upload
- Responsivity
- Soft delete for products and categories with ability to restore
- Database structure allows to change products and shipping methods without messing order history

## 2. Structure
- Database seeders
  - DatabaseSeeder: run model factories and other two seeders
  - DesiredValueSeeder: seed custom values to DB
  - PivotTableSeeder: seed pivot tables, I've done it this way to avoid creating models just for seeding purposes

- View composers
  - CategoryComposer: get all categories for nav
  - CartItemsComposer: get cart items for nav
  - LatestProductComposer: get 6 latest products for layout

- Traits
  - CartItemsTrait: get cart items, quantities for every item, total price, and check if any item was bought in the meantime
  - digitsToWordsTrait: translate cost in digits to written words (required for polish invoices). You need to adjust this method to your needs

- Artisan Commands
  - `php artisan image:clear`: delete "orphaned" images. As dropzone works asynchronously there might be situations where admin ads images without saving rest of the content. This command handles it.

- Schedule
  - clean "orphaned" images as described above (daily)
  - manage queue (every minute)

- Listeners
  - CreateInvoice: in PDF, save it and attach to e-mail with order details
  - SendOrderDetails: e-mail to user and BCC to owner

- Events
  - OrderCreated: for above listeners

- Notifications
  - OrderShipped: send SMS to user via NEXMO
  - OrderStatusChanged: send Markdown e-mail to user
  - ResetPasswordNotification: same as above, comes with Laravel auth

- Mail
  - ContactForm: send info to owner
  - OrderCreated: send order details to user and BCC to owner

- App service provider
  - set morph map for polymorphic relation
  - automatically create slug before add and update page, product, category and blog post
  - automatically insert uuid when creating new order

- Middleware
  - IsAdmin: check if current user is administrator

- Requests
  - validation rules for BlogPost, Category, Email, Order, Page, Product, ShippingMethod, User (cleaner controllers)

- Blade components
  - cartItems
  - postGrid
  - productGrid

- Laravel Mix (*webpack.mix.js* in root directory)
  - optimize all image assets (webpack plugin) and copy them to *public/images*
  - translate ES6, join and minify Javascript files (output: app.js and admin.js)
  - compile SASS to CSS, join and minify CSS files (output: app.css and admin.css)
  - add random value to asset names in production to prevent caching

## 3. Todo
- More browser/unit tests
- Code refactoring
- Extend dropzone with drag and drop
- Navigation CRUD with drag and drop
- AJAX Duplicate check when title field was focused out
- Add more complex auth with user roles
- Add Google captcha if needed
- **Create backend API with Laravel/Lumen using JWT or Laravel Passport and frontend client with Vue.js**

## 4. Tests
I've written a couple of browser tests using Laravel Dusk. To run them type:<br />
`php artisan dusk`

To run single test you need to provide it's full path:<br />
`php artisan dusk tests\browser\OrderTest.php`

I'm planning to add more tests soon, using pure PHPUnit as well (Dusk is pretty slow ATM).

## 5. Dependencies
### 5.1. Composer
- *barryvdh/laravel-debugbar*: debug bar useful for development, it appears at the bottom of page
- *barryvdh/laravel-dompdf*: create PDF for invoices
- *laravel/dusk*: create browser tests
- *laravel/socialite*: login via Google/Facebook/Twitter
- *nexmo/laravel*: send SMS when order is shipped
- *unisharp/laravel-filemanager*: useful filemanager added to WYSIWYG
- *uxweb/sweet-alert*: nice looking messages
- *webpatser/laravel-uuid*: create unique IDs for orders

### 5.2. Node.js
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
*Install Composer and Node.js if you don't have it. You will also need HTTP and MySQL server (I recommend Laravel Homestead, or XAMPP). This app uses PHP 7 syntax so PHP 7 is required as well.*

- Clone repository:<br />
`git clone https://github.com/bogumilkorek/cudomisie`

- Go into created directory:<br />
`cd cudomisie`

- Rename *.env.example* to *.env* and insert your data

- Generate app key:<br />
`php artisan key:generate`

- Install Composer dependencies:<br />
`composer install`

- Install Node.js dependencies:<br />
`npm install`

- Run your virtual machine, or HTTP/MySQL server:<br />
`vagrant up` or start XAMPP and copy *cudomisie* directory into XAMPP's *htdocs*, or start XAMPP's MySQL server and start PHP's default server `php artisan serve`

- If you chose XAMPP or other tool create new database and update your *.env* file

- Run DB migrations:<br />
`php artisan migrate`

- If you want to fill DB with example values:<br />
`php artisan db:seed`

- Compile, join and minify SASS and Javascript assets:<br />
`npm run dev`

- Run queue via schedule (or change `QUEUE_DRIVER=database` to `QUEUE_DRIVER=sync` in your *.env* file):<br />
`php artisan schedule:run`

- Run tests:<br />
`php artisan dusk`

## 7. License
Both personal and commercial use allowed without any restrictions.<br /><br />
Feel free to ask me any questions.<br /><br />
**Code reviews are always much appreciated :)**
