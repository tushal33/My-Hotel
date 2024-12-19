Book Your Hotel - Database README

Overview

This repository contains the SQL dump for the book_your_hotel database. It is designed to manage hotel booking operations, including administrator details, hotel data, and other related entities.

Database Details

Database Name: book_your_hotel

SQL Dump File: book_your_hotel.sql

Generated Using: phpMyAdmin (version 5.2.1)

Server Version: MariaDB 10.4.32

PHP Version: 8.2.12

Tables in the Database

1. admins

This table stores the details of hotel administrators.

Columns:

id (int, Primary Key): Unique identifier for the admin.

username (varchar): Admin username.

hotel_name (varchar): Name of the hotel associated with the admin.

mobile (int): Admin’s mobile number.

password (varchar): Encrypted password.

2. Additional Tables

The database may contain other tables related to hotel bookings, customers, reservations, etc., as indicated by the full SQL dump.

Import Instructions

Ensure that you have MySQL or MariaDB installed on your system.

Open your database management tool (e.g., phpMyAdmin, MySQL Workbench, or command line).

Create a new database named book_your_hotel.

Import the SQL file:

For phpMyAdmin:

Navigate to the Import tab.

Select the book_your_hotel.sql file and click Go.

For Command Line:

mysql -u [username] -p book_your_hotel < book_your_hotel.sql

Notes

Ensure you configure the appropriate database user permissions.

The database uses utf8mb4 character encoding for extended Unicode support.

Default values and constraints should be reviewed to align with your application’s requirements.

License

This SQL dump is provided as-is. Ensure compliance with any applicable legal or organizational policies before use.

Contact

For questions or support, please contact the database administrator or the development team responsible for the Book Your Hotel project.

