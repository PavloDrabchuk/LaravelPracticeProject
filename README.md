# Back-End for online store  [Created with Laravel]

The project implements an API for online store functions and an admin dashboard.

## Description

### The system provides two roles:
* User
* Admin

### Using this system you can **(as Admin)**:
* Register admin profile
* Manage the content of the database using the admin dashboard

  <img src="https://user-images.githubusercontent.com/38464535/211389409-fac13962-a6c7-419e-a716-fbff49b996e0.png" width=85%>
* Perform CRUD operations with users
* Perform CRUD operations with categories
  > The possibility of multi-language is supported
* Perform CRUD operations with products
  > The price in different currencies is automatically calculated at the NBU exchange rate using the API

  <img src="https://user-images.githubusercontent.com/38464535/211385763-9560f377-cb96-4905-a364-06751e46a038.png" width=85%>

* Perform CRUD operations with currencies
  > Currency codes are loaded using the NBU API.

  <img src="https://user-images.githubusercontent.com/38464535/211390581-339957a8-3f0b-4067-bbf5-27ff2b96ee18.png" width=60%>

### Endpoints **(created with Swagger)**:

<img src="https://user-images.githubusercontent.com/38464535/211391812-efe773c5-ef7a-4e9c-85fd-4ac097ded3d3.png" width=85%>

### Features:
* After completing the order, the user is sent an e-mail with information about the purchase;
* Emails are sent in a queue.

## Built With

* Laravel
* MySQL
* Swagger
* PHPUnit

## Getting Started

### Installing

1. Clone the repo
   ```sh
   git clone https://github.com/PavloDrabchuk/LaravelPracticeProject.git
   ```
2. Rename `.env.example` to `.env`
3. Enter your e-mail and password as admin in `.env`
   ```.env
   ADMIN_EMAIL=admin@example.com
   ADMIN_PASSWORD=password
4. Enter user phone and password in `.env`
   ```.env
   USER_PHONE=380123456789
   USER_PASSWORD=password
5. Enter your datasource settings in `.env`
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=database_name
   DB_USERNAME=username
   DB_PASSWORD=password
6. Enter your email sender info in `.env`
   ```env
   MAIL_USERNAME=mail_username
   MAIL_PASSWORD=mail_password
7. Run migration and seeder
   ```sh
   php artisan migrate:refresh --seed
   ```

### Executing program

* Run project with command in terminal
  ```sh
  php artisan serve
* Open in your web browser:
   ```
   http://127.0.0.1:8000/
   ```

## Help

If you have a problem or question, write me: ravluk2000@gmail.com

## Author

* **Pavlo Drabchuk** - ravluk2000@gmail.com

