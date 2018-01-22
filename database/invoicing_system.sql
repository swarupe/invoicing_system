DROP DATABASE IF EXISTS invoicing_system;

CREATE DATABASE invoicing_system;

USE invoicing_system;

CREATE TABLE user (User_Id int AUTO_INCREMENT PRIMARY KEY, Name char(20),Username varchar(20), Password varchar(20), Role varchar(20))AUTO_INCREMENT = 1000000;
INSERT INTO `user`(`Name`,`Username`,`Password`,`Role`) VALUES ('Swaroop','swaroop','swaroop','Admin');

CREATE TABLE tax (Tax_Id int AUTO_INCREMENT PRIMARY KEY, CGST decimal,SGST decimal,IGST decimal, User_Id int, foreign key(User_Id) references user(User_Id))AUTO_INCREMENT = 10000;


CREATE TABLE customer (Customer_Id int AUTO_INCREMENT PRIMARY KEY,GSTIN int(16) UNIQUE NOT NULL, Name char(20), Contact_Phone varchar(11), Contact_email varchar(25), Address char(30), City char(20), PIN int, User_Id int, foreign key(User_Id) references user(User_Id))AUTO_INCREMENT = 1000;


CREATE TABLE product (Product_Id int AUTO_INCREMENT PRIMARY KEY, Name char(20), Version char(10), Type char(15), Price decimal, User_Id int, foreign key(User_Id) references user(User_Id)) AUTO_INCREMENT=100;


CREATE TABLE invoice (Invoice_Id int AUTO_INCREMENT PRIMARY KEY, Invoice_No int UNIQUE NOT NULL, Invoice_Date varchar(10), Invoice_To int, foreign key(Invoice_To) references customer(Customer_Id))AUTO_INCREMENT = 1;


CREATE TABLE invoice_items (Invoice_Item_Id int AUTO_INCREMENT PRIMARY KEY, Product_Id int, Description char(30), Quantity int, Subtotal decimal, Tax_Id int, Total_Amount decimal, Invoice_Id int, foreign key(Product_Id) references product(Product_Id), foreign key(Tax_Id) references tax(Tax_Id), foreign key(Invoice_Id) references invoice(Invoice_Id))AUTO_INCREMENT = 10;

