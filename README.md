# The API/Back End of Portfolio Website 
- It is an API of my portfolio website. It is developed using the Lumen Framework. This API contains users table, introductions table to save a simple introduction, works table to save project data, and connections table to save personal contact.  
- You can see my portfolio website at https://hammamislami.herokuapp.com/ 
- The front end for this API is available at https://github.com/glayOne23/the-frontend-of-portfolio-website
## Project setup
```
git clone https://github.com/glayOne23/the-api-of-portfolio-website.git
cd the-api-of-portfolio-website
composer install
cp .env.example .env
php artisan jwt:secret
```

### Databse Setup :
1. create database
2. set .env file
    ```php
    DB_DATABASE = your_db_name
    DB_USERNAME = your_username
    DB_PASSWORD = your_username_password
    ```
3. migrate :
    ``` 
    php artisan migrate --seed
    ```
4. run server :
    ```
    php -S localhost:8000 -t public
    ```
### Login :
- username : admin
- password : 123