# Parole
web app to simulate managing access of clients requests by one or several administrator, where the admin can (give/refuse/end) the access for only one client in time, here an example of management of requests to speak.
## Used Tools
`Wampserver 3.2.3`, `PHP 7.4.9`,  `MYSQL 5.7.31`,  `Apache 2.4.46`.
## How to configure?
- use phpmyadmin and create a new database named : `parole`
- use the file `parole.sql` in /db in the project directory and run it
- change your sql database server : `address, username, password` in file `DB_config.sql`
## How to run?
- open [http://localhost/Parole](http://localhost/Parole) to view it in your browser and login.
- default admin account => username: `admin` , password: `admin`.
- default user1 accounts => username: `user1` , password: `user1`.
- default user2 accounts => username: `user2` , password: `user2`.
## Screenshots
![login](https://github.com/DEVLOKER/Parole/blob/main/screenshots/login.jpg?raw=true "login page")
![home_user_1](https://github.com/DEVLOKER/Parole/blob/main/screenshots/home_user_1.jpg?raw=true "user home page (request to talk, cancel request)")
![home_user_2](https://github.com/DEVLOKER/Parole/blob/main/screenshots/home_user_2.jpg?raw=true "request to talk and wait authorization from admin...")
![home_admin_1](https://github.com/DEVLOKER/Parole/blob/main/screenshots/home_admin_1.jpg?raw=true "admin home page (all requests users list)")
![home_admin_2](https://github.com/DEVLOKER/Parole/blob/main/screenshots/home_admin_2.jpg?raw=true "the admin is authorize 'user1'")
![accounts_admin_3](https://github.com/DEVLOKER/Parole/blob/main/screenshots/accounts_admin_3.jpg?raw=true "users management (add-update-delete)")
![add_admin_4](https://github.com/DEVLOKER/Parole/blob/main/screenshots/add_admin_4.jpg?raw=true "add new user form")
![password_admin_4](https://github.com/DEVLOKER/Parole/blob/main/screenshots/password_admin_4.jpg?raw=true "admin password change")