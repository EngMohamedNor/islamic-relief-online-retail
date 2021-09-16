
This app was built according to the requirements of  the assessment

Main Modules:

1. Users accounts and Authentication & Authorization 

there are two user types : admin and Customer

by Default, the app creates new admin user automatically with the first request, using the following credentials

email: admin@gmail.com
password: 12345678

- customers can register user accounts.
- customers should create user account before making new order.
- Authorization Check is done for Admin Pages [ route protection]
 

2. Product Listing.

* Please run the following command to populate Products data 
  php artisan db:seed --class=DatabaseSeeder

3. Order creation and cart management

4. Order Receipt (Invoice) 
 - Displayed after successful checkout
 - can be reprinted by both admin and customer from order listing page

5.  Order listing (My Orders) for customer

6.  Order Management page for admin
- check all orders
- update order status

 
7. API Endpoint for Orders : /api/orders/list



Technology Used

•	Laravel version 8
•	Mysql
•	Jquery
•	Boostrap


This work includes some design elements & images from the interned under Creative Commons licence

