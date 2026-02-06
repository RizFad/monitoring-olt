Monitoring OLT System

Aplikasi ini adalah sistem monitoring perangkat OLT dan ONU berbasis CodeIgniter yang digunakan untuk memantau status perangkat, GPON, dan informasi jaringan.

Requirements

PHP 7.4+

MySQL / MariaDB

Apache / Nginx

Composer (optional)

Installation (Local)
1. Clone / Copy Project

Letakkan project di folder web server:

htdocs/monitoring-olt


atau

/var/www/html/monitoring-olt

2. Import Database

Buka phpMyAdmin

Buat database baru:

monitoring


Import file database yang tersedia pada project:

Monitoring.sql

3. Setting Database

Edit file:

application/config/database.php


ubah sesuai database lokal:

'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'monitoring',

4. Jalankan Project

Buka browser:

http://localhost/monitoring-olt

Login Default

Gunakan user berikut:

Username	Password	Role
admin	admin123	admin
operator1	operator123	operator

Password disimpan menggunakan MD5.

Production Access

Jika aplikasi sudah di-deploy pada server production, sistem dapat diakses melalui:

https://monitoring.poltekad-elektro.my.id/monitoring-olt/auth


Pastikan:

Database sudah di-import

Config base_url di config.php sudah disesuaikan

Permission folder application/logs writable

Features

Monitoring OLT

Monitoring ONU

ONU Detail (Network, WiFi, GPON)

Status Online / Offline toggle

Dashboard Monitoring

Author

Monitoring OLT System
Network Operation Center (NOC)