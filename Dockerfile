# ใช้ PHP 8.2 ที่มาพร้อม Apache
FROM php:8.2-apache

# ติดตั้ง Extension ที่จำเป็นสำหรับต่อ MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# เปิดใช้งาน mod_rewrite (เผื่ออนาคตต้องใช้ .htaccess)
RUN a2enmod rewrite