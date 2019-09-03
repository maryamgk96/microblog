# microblog
Setup the project:

    1)Clone the project.

    2)Duplicate the .env.example to be .env and set up your database configeration.

    3)php artisan key:generate

    4)php artisan migrate

    5)composer install

    6)php artisan passport:install

    7)php artisan serve



Headers:
1) All apis:

       ‘X-localization’ => ‘ar’ or ‘en’

       'Accept' => 'application/json'

2) Api that needs authentication:

        'Authorization' => 'Bearer ' + accessToken
 
 
* you'll recive access token when you register or login.

Apis:

  1) /api/register. Post

     Body: name,email,password,image


  2) /api/login. Post

     Body: email,password


  3) /api/tweets. Post

     Body: body.

  4) /api/tweets. Delete

     Body: id. 

  5) /api/followuser. Post

     Body: user_id.

  6) /api/timeline/. Get
     
