# Edfa3ly-Yashry

[![N|Solid](https://avatars3.githubusercontent.com/u/4144954?s=200&v=4)](https://nodesource.com/products/nsolid)

Write a program that can price a cart of products, accept multiple products, combine offers, and display a total detailed bill in different currencies (based on user selection).

# Abstract
This task is the part invoicing system I have it before, invoicing For every product sold or service rendered, an invoice is made, the first step for you to get paid, In this task, we have products, offers, and total calculations of all transactions.

# Problem Definition
the system must be able to add new offers for any products, it means that there are multiple offers for a single product and this offers couldn't occur without another product must be taken, for example 
product A has an offer of 50% if you buy 2 from product B and 2 from product 3, and you have to handle if the customer takes more than 2 from product A Double Offer or tribble offer there are many situations.

# The Solution Of Problem!
 I made databse tables for multiple models 
  > tbl_tax --> to save the tax , type and accept multiple tax.
 > tbl_product --> to save the products , price and tax if exist
> tbl_offer --> to create different offers for product.
> tbl_offer_depend --> refer to conditions of offer occurrence, it maps the offer depends on which product and how many items you need to the occurrence.
> tbl_bill --> refer to final card car or invoice
> tbl_bill_row --> refer to rows of the bill or mean the item's type based (product, tax, discount) and then you have to calculate from this table.

Attention : 
you can add and edit in the database
you can add new offers with any offer you added you must add its dependence at table tbl_offer_depend
### Installation

- import edfa3ly-yashry.sql to your host, it is  https://github.com/DavidaAtef82/Edfa3ly-Yashry/blob/main/edfa3ly-yashry.sql

- Change database connection configurations
from file inc/connection.php it is 
https://github.com/DavidaAtef82/Edfa3ly-Yashry/blob/main/Edfa3ly-Yashry/inc/connection.php
- use postman or any other tool to send post request to    
   Your-host/Edfa3ly-Yashry/
and in the Body add this 
| KEY         |  VALUE |
| ---------- | ------ |
| products | T-shirt,T-shirt,Shoes,Jacket |
| currency | EGP |
 - or use get request Like
   Your-host/Edfa3ly-Yashry/index.php?products=T-shirt,T-shirt,Shoes,Jacket
