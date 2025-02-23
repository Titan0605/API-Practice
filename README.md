## ***Goals***
1. Develop an API which can perfom GET, POST, PUT and DELETE methods.
2. Save the data in a MySQL databse.
3. Show the data in the front-end.

## ***Tools used***
- PHP
- MySQL (XAMPP)

---

## ***STEPS TO FOLLOW BEFORE USE THE API***
1. **Creat a database in MySQL named "videogames"**
2. **Import the videogames.sql which it is in the SQL folder in the database**
3. **Move the .zip of this project to "C:\xampp\htdocs" and extract the folders inside it, in a folder call "api-practice" (IF THE FOLDER HAVE OTHER NAME IT WON'T WORK!)**
4. **You need to create a VirtualHost with Xammp**
 - Add the Vhost in Xampp
    - Go to: "C:\xampp\apache\conf\extra\httpd-vhosts.conf"
    - Add the next hosts in the last part of the document like this: 
```txt
    <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
    </VirtualHost>
```

```txt
    <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/api-practice/public"
    ServerName apipractice.com
    </VirtualHost>
```
  -  Save the file
5. **Add the new virtualhost to Windows domains(This will let us call the API from other project in the PC)**
 - Add the Vhost in Xampp
    - Go to: "C:\Windows\System32\drivers\etc\hosts"
    - In #domain names add:
```
    127.0.0.1 apipractice.com
```
  - Save the file (As Administrator, if not, it won't save the local domain)
6. **Start the server in Xampp or reload if it was turned on**
7. **Go to the project datatables_practice to test the API with datatables**
