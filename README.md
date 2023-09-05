# JsonApi
*JsonApi is a CRUD API with data stored in JSON file.
 The objective is to illustrate the use of Json file to 
 store data. A CRUD action is performed on the file through
 A backend API written in PHP. There is an XMLHTTP ajax request 
 to communicate with the API through endpoints.
 
*JsonApi is  Built with PHP, JavaScript, HTML and bootstrap.

## Scripts
 * index.html for displaying all the products. It exists as a single page application. 
   A click on the add button, a form for entering new data is displayed. A click on 
   the edit button opens up the edit form populated with the edit data for the 
   particular index.
   
 * Products.js which contains javascript functions for making
   ajax calls to the functions.php for the CRUD operations.
    
 * product.json file for storage of orders
 * functions.php which contains the CRUD API functions.

## Application
Data can be stored in jsonfile instead of database. 
The use of json file for storing data allows
data interchange between the server and frontend
applications. It can be enhanced with further features.
For instance, additions and editing of records can be
carried out only by an authenticated admin user.
