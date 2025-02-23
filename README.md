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
1. Move the .zip of this project to "C:\xampp\htdocs" and extract the folders inside it, in a folder call "api-practice" (IF THE FOLDER HAVE OTHER NAME IT WON'T WORK!).
2. You need to create a VirtualHost with Xammp.
  - Go to: "C:\xampp\apache\conf\extra\httpd-vhosts.conf"
  - Add the next hosts in the last part of the document like this:
```
    <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
    </VirtualHost>
```
```
    <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/api-practice/public"
    ServerName apipractice.com
    </VirtualHost>
```
3. Add the new virtualhost to Windows domains(This will let us call the API from other project in the PC).
  - Go to: "C:\Windows\System32\drivers\etc\hosts"
  - In #domain names add:
```
    127.0.0.1 apipractice.com
```
4. Start the server in Xampp or reload if it was turned on.
5. Go to the project datatables_practice to test the API with datatables.
