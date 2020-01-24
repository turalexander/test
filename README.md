# Инструкция для OpenServer

## Используемое ПО: PHP 5.4, MySQL 5.1, Apache 2.2

В папке OSPanel/domains создать папку и скопировать проект

Добавить в конец файла <путь к OpenServer>/userdata/config/Apache_2.2-PHP_5.2-5.4_vhost.conf
и перезагрузить Apache

```
<VirtualHost *:80>
  DocumentRoot <путь к OpenServer>\domains\<название папки>\web
  DirectoryIndex index.php
  ServerAlias <название папки>
  <Directory "<путь к OpenServer>\domains\<название папки>\web">
    AllowOverride All
    Allow from All
  </Directory>
  Alias /sf <путь к OpenServer>\domains\<название папки>\lib\vendor\symfony\data\web\sf
  <Directory "<путь к OpenServer>\domains\<название папки>\lib\vendor\symfony\data\web\sf">
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>
```
Создать базу данных 
>mysqladmin -u<username> -p <password> create <db_name> 

В консоли перейти в папку проекта и выполнить:
  >php symfony configure:database "mysql:host=localhost;dbname=<db_name>" <username> <password> 
  
Заменить name,username и password на свои

В консоли перейти в папку проекта и выполнить: 
  >php symfony doctrine:insert-sql

В консоли перейти в папку проекта и выполнить: 
  >php symfony generate <число>. Для генерации заказов

В браузере перейти по адресу:
 ><название папки(ServerName)>/order 