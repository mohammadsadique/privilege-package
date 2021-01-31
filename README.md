# Privilege or Role Assign package




[![Issues](https://img.shields.io/github/issues/mohammadsadique/privilege-package?style=flat-square)](https://github.com/mohammadsadique/privilege-package/issues)
[![Stars](https://img.shields.io/github/stars/mohammadsadique/privilege-package?style=flat-square)](https://github.com/mohammadsadique/privilege-package/stargazers)



## Dynamically pages give to other user.

Install Package
composer require sadique/privilege

Run Migrate
php artisan migrate

Publish blade page to your views folder (Go to resources/views/vendor/privilege/all blade pages)
php artisan vendor:publish


Note:- Please make `logins` table 

        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('privilege_id')->nullable();
            $table->timestamps();
        });