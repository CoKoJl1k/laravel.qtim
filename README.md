===============================================
POST
http://laravel.qtim/api/login
{"email":"test@gmail.com","password":"1111"}
================================================
GET
http://laravel.qtim/api/news
================================================
GET
http://laravel.qtim/api/news/58/edit
================================================
PUT
http://laravel.qtim/api/news/58
{"title": "title","description": "description"}
================================================
DELETE
http://laravel.qtim/api/news/63


============================================отслеживание очередей
php artisan queue:work --queue=default2,default3,default
--------------------
php artisan horizon
===================================================================
