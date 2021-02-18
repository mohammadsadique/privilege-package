# Privilege or Role Assign package




[![Issues](https://img.shields.io/github/issues/mohammadsadique/privilege-package?style=flat-square)](https://github.com/mohammadsadique/privilege-package/issues)
[![Stars](https://img.shields.io/github/stars/mohammadsadique/privilege-package?style=flat-square)](https://github.com/mohammadsadique/privilege-package/stargazers)



## Dynamically pages give to other user.

Install Package :
#### composer require sadique/privilege

Run Migrate :
#### php artisan migrate

Publish blade page to your views folder (Go to resources/views/privilege/all blade pages)
### php artisan vendor:publish


Note:- Please make `logins` table 

        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('privilege_id')->nullable();
            $table->timestamps();
        });


##  URL Route Links

1. http://projecturl/addpages
2. http://projecturl/showprivilege
3. http://projecturl/assignprivilege


Email: [mdsadiquedeveloper@gmail.com](mailto:mdsadiquedeveloper@gmail.com)<br />
WhatsApp Web [(91) 97705-99354](https://web.whatsapp.com/send?phone=9770599354)<br />
WhatsApp Mobile [(91) 97705-99354](https://api.whatsapp.com/send?phone=9770599354)<br />