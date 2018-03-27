# Folder application

Features:
* Registration
* Sign in
* Creating nested folders

## Requirements

* PHP ≥ 7.1 
    * intl, apcu, opcache
* MySQL ≥ 5.5
* Node.js 9.9.0
* yarn 1.5.1
* composer (could be user composer phar from project root)

## Setup

#### MySQL
For setup you need create database for application:
1. Run `mysql -uroot` (if installed from brew)
1. Run query `CREATE DATABASE folders;`
1. Run `exit`.

#### Application
* Clone project repository 
```
git clone https://github.com/quantizer/folders-demo.git your-folder
```

* Move to project folder `cd your-folder`
* Run `php composer.phar install` for installing all vendor files for back-end
* Run `yarn install` for downloading js libraries 
* Run `yarn run encore production` for js build
* Open `your-folder/.env` file and find here `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name` and update to:
```
DATABASE_URL=mysql://root:@127.0.0.1:3306/folders
```
* Run `php bin/console server:run` for web-server and you will see:
```                                                                                                                    
 [OK] Server listening on http://127.0.0.1:8000                                                                         
                                                                                                                        

 // Quit the server with CONTROL-C.                                                                                     

PHP 7.1.14 Development Server started at Tue Mar 27 22:00:02 2018
Listening on http://127.0.0.1:8000
Document root is /some/user/specific/path/your-folder/public
Press Ctrl-C to quit.

```
* Open [http://127.0.0.1:8000](http://127.0.0.1:8000)
