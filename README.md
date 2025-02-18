# MK's Sports Store
Project_1 - Add_Cart_View_Cart

Description

MK's Spot is an e-commerce website that provides users with an intuitive shopping experience. The platform allows users to register, browse products, add items, manage their cart, and proceed to checkout. The project is developed locally and will be deployed on a GoDaddy web server.

Features

User Registration & Login: Prevents duplicate email registration.

Product Listing: Displays products with images, descriptions, and prices.

Shopping Cart: Add, remove, and update items with subtotal and total calculations.

Checkout Process: Users can review their cart and complete their order (without payment processing).

Database Integration: Reads and writes all relevant user and product data.


Technologies Used

Frontend: HTML and CSS

Backend: PHP

Database: MySQL

Deployment: GoDaddy Web Hosting


Installation Instructions

Clone the repository:

git clone (https://github.com/YTmash/Project_1---Add_Cart_View_Cart/blob/main/README.md)

Navigate to the project directory:

cd Project_1 - Add_Cart_View_Cart

Set up a local PHP environment (XAMPP, WAMP, or LAMP).

Import the provided MySQL database file (schema.sql) into your database.

Start the PHP server and visit http://localhost/index.php.

Database Schema

Users Table

Column

Type

Description

id

INT (PK)

Auto-incremented user ID

name

VARCHAR(255)

Full name of the user

email

VARCHAR(255)

Unique email for registration

password

VARCHAR(255)

Hashed password

Products Table

Column

Type

Description

id

INT (PK)

Auto-incremented product ID

name

VARCHAR(255)

Product name

description

TEXT

Product details

price

DECIMAL(10,2)

Product price

image

VARCHAR(255)

Image URL

Cart Table

Column

Type

Description

id

INT (PK)

Auto-incremented cart ID

user_id

INT (FK)

User associated with the cart

product_id

INT (FK)

Product added to the cart

quantity

INT

Quantity of the product


Deployment on GoDaddy

Upload all project files to GoDaddy’s hosting server.

Configure the database using GoDaddy’s MySQL panel.

Update the database connection settings in config.php.

Ensure the PHP and Node.js backend is properly linked.

Access the site via your GoDaddy domain.


Future Enhancements

Implement payment processing (PayPal, Stripe integration).

Add user profile management.

Improve product filtering and search functionality.

Implement order history tracking.

Contact

For any inquiries or contributions, feel free to reach out to mimashego@gmail.com or visit the GitHub repository.



