<?php
require (__DIR__."/../../bootstrap/bootstrap.php");

if(isset($_SERVER['REQUEST_METHOD'])){
$param = $_SERVER['REQUEST_METHOD'];
switch($param){
case 'POST':
    createproduct();
    break;
case 'GET':
    loadallproducts();
    break;
case 'PUT':
    updateproduct();
    break;
default:
 deleteproduct();
    
}
}


function createproduct(){

//get the value of variables from the post method received

if(isset($_POST['create'])){

if(isset($_POST['product'])){
$product = $_POST['product'];
}

if(isset($_POST['quantity'])){
$quantity = $_POST['quantity'];
}  

if(isset($_POST['price'])){
$price = $_POST['price'];
} 

if(isset($_POST['amount'])){
$amount = $_POST['amount'];
} 
          
if(isset($_POST['orderdate'])){
$orderdate = $_POST['orderdate'];
}           

// put into array the incomming variables
$newdata = array('product'=>$product,'quantity'=>$quantity,'price'=>$price,
'amount'=>$amount,'orderdate'=>$orderdate);

//Get the contents of the json file
$filedata = file_get_contents(WORKING_DIR_PATH.'/public/products.json');

// convert the contents into PHP array
$filedata = json_decode($filedata, true);
    
// declare an array to store the contents of the  $filedata  and the $newdata
$newfiledata =[];
    
// Store the $filedata and $newdata into the %neefiledata
    
$newfiledata =$filedata;
$newfiledata = $newdata;

// convert the $newfiledata into json and save into json file
$newfiledata = json_encode($newfiledata);
$result = file_put_contents(WORKING_DIR_PATH.'/public/products.json', $newfiledata);
if($result) {$success = "data saved into json file";
}else {$success = "data not saved into json file";
}
return $success;
} 
}

function loadallproducts(){
// fetch all products from json file
if(!isset($_GET['edit'])){
$jsondata = file_get_contents(WORKING_DIR_PATH.'/public/products.json');
return $jsondata;
}else{editproduct();}
}


function editproduct(){
// get the edit parameter
// loop through the json file and update the right product

if(isset($_GET['edit'])){
$edit= $_GET['edit'];
$jsondata = file_get_contents(WORKING_DIR_PATH.'/public/products.json');
$jsondata = json_decode($jsondata,true);
for($i=0;$i<count($jsondata);$i++){
$obj =$jsondata[$i]; 
if($obj['id']==$edit) return json_encode($obj);
}
}
}

function updateproduct(){
if(isset($_POST['update'])){
$id =isset($_POST['id']) ? $_POST['id'] : "";
$product = isset($_POST['product']) ? $_POST['product'] : "";
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";
$amount = isset($_POST['amount']) ? $_POST['amount'] : "";
$orderdate = isset($_POST['orderdate']) ? $_POST['orderdate'] : "";
$jsondata = file_get_contents(WORKING_DIR_PATH.'/public/products.json');
$jsondata = json_decode($jsondata, true);

for($i=0;$i<count($jsondata);$i++){
$obj = $jsondata[$i];
if($obj['id'] == $id){
$obj['product'] = $product;
$obj['quantity'] = $quantity;
$obj['price'] = $price;
$obj['amount'] = $amount;
$obj['orderdate'] = $orderdate;
$jsondata = json_encode($jsondata);
$result = file_put_contents(WORKING_DIR_PATH.'/public/products.json',$jsondata);
if($result) {$success = "data succesfully updated";
}else {$success = "data not saved into json file";
}
return $success;
}
}
}
}

function deleteproduct(){
if(isset($_GET['delete'])){
$delete = $_GET['delete'];
$jsondata = file_get_contents(WORKING_DIR_PATH.'/public/products.json');
$jsondata = json_decode($jsondata,true);
for($i=0;$i<count($jsondata);$i++){
$obj = $jsondata[$i]; 
if($obj['id']==$delete){
 $key = array_search($obj,$jsondata);
 array_splice($jsondata,$key,1);
 json_encode($jsondata);
 $result = file_put_contents(WORKING_DIR_PATH.'/public/products.json',$jsondata);
 if($result){$success ="data successfully deleted";
}else{$success = " No file was deleted ";
}
return $success;
}
}
}
}

?>
