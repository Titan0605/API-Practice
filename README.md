***Goals***
1. Develop a seudo-API which can perfom GET, POST, PUT and DELETE methods.
2. Save the data in a MySQL databse.
3. Show the data in the front-end.

***Tools used***
- PHP
- Javascript
- HTML
- CSS
- MySQL (XAMPP)

***STEPS TO FOLLOW BEFORE USE THE API***
1. You need to create a VirtualHost with Xammp
  - Go to: xampp/apache/conf/extra/vhost
  - Add the next hosts in the last part of the document:

    <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
    </VirtualHost>
    
    <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/api-practice/public"
    ServerName [apipractice.com](http://apipractice.com/)
    </VirtualHost>

2. Add the new virtualhost to Windows domains(This will let us call the API from other project in the PC)
  - Go to: windows/system32/drivers/etc/hosts
  - In #domain names add:
    
    127.0.0.1 [apipractice.com](http://apipractice.com/)
