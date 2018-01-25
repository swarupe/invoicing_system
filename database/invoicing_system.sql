DROP DATABASE IF EXISTS invoicing_system;

CREATE DATABASE invoicing_system;

USE invoicing_system;

CREATE TABLE user (User_Id int AUTO_INCREMENT PRIMARY KEY, Name char(20),Username varchar(20), Password varchar(20), Role varchar(20))AUTO_INCREMENT = 1000000;
INSERT INTO `user`(`Name`,`Username`,`Password`,`Role`) VALUES ('Swaroop','swaroop','swaroop','Admin');

CREATE TABLE tax (Tax_Id int AUTO_INCREMENT PRIMARY KEY, CGST decimal,SGST decimal,IGST decimal, User_Id int, foreign key(User_Id) references user(User_Id))AUTO_INCREMENT = 10000;


CREATE TABLE customer (Customer_Id int AUTO_INCREMENT PRIMARY KEY,GSTIN varchar(16) UNIQUE NOT NULL, Name char(20), Contact_Phone varchar(11), Contact_email varchar(25), Address char(30), City char(20), PIN int, User_Id int, foreign key(User_Id) references user(User_Id))AUTO_INCREMENT = 1000;


CREATE TABLE product (Product_Id int AUTO_INCREMENT PRIMARY KEY, Name char(20) UNIQUE NOT NULL, Version char(10), Type char(15), Price decimal, User_Id int, foreign key(User_Id) references user(User_Id)) AUTO_INCREMENT=100;


CREATE TABLE invoice (Invoice_Id int AUTO_INCREMENT PRIMARY KEY, Invoice_No int UNIQUE NOT NULL, Invoice_Date varchar(30), Invoice_To varchar(16), foreign key(Invoice_To) references customer(GSTIN))AUTO_INCREMENT = 1;


CREATE TABLE invoice_items (Invoice_Item_Id int AUTO_INCREMENT PRIMARY KEY, Product_Name char(20), Description char(50), Item_Base_Price decimal ,Quantity int, Subtotal decimal, CGST_Price decimal, SGST_Price decimal, IGST_Price decimal, Total_Amount decimal, Invoice_No int, foreign key(Product_Name) references product(Name) ,foreign key(Invoice_No) references invoice(Invoice_No))AUTO_INCREMENT = 10;

