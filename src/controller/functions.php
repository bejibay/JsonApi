<?php

if(isset($_SERVER['REQUEST_METHOD'])){
$param = $_SERVER['REQUEST_METHOD'];
switch($param){
case 'POST':
    createproduct();
    break;
case 'GET':
    loadallproducts();
    break;
case 'GET':
    editproduct();
    break;
case 'PUT':
    updateproduct();
    break;
default:
     deleteproduct();
    
}
}

$product=$quantity=$price=$orderdate =$amount = "";

function createproduct(){

    

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
    
    
    } 
}

    $newdata = array('product'=>$product,'quantity'=>$quantity,'price'=>$price,
    'amount'=>$amount,'orderdate'=>$orderdate);

    //Get the contents of the json file
    $filedata = file_get_contents("../../public/products.json");

    // convert the contents into PHP array
    $filedata = json_decode($filedata, true);
    
    // declare an array to store the contents of the  $filedata  and the $newdata
    $newfiledata =[];
    
    // Store the $filedata and $newdata into the %neefiledata
    
    $newfiledata =$filedata;
    $newfiledata = $newdata;

   // convert the $newfiledata into json and save into json file
    $newfiledata = json_encode($newfiledata);
    $result = file_put_contents("../../public/products.json", $newfiledata);
    if($result) {return $success = "data saved into json file";}
    return $success = "data not saved into json file";
    


function loadallproducts(){
$jsondata = file_get_contents("../../public/products.json");
return $jsondata;
}


function editproduct($id){
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
$jsondata = file_get_contents("../../public/products.json");
$jsondata = json_decode($jsondata,true);
$jsondata = count($jsondata);
for($i=0;$i<$jsondata;$i++){
  $obj =$jsondata[$i]; 
  if($obj['id']==$id) return json_encode($obj);
  
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
    $jsondata = file_get_contents("../../public/products.json");
    $jsondata = json_decode($jsondata, true);
    $jsondata = count($jsondata);
    for($i=0;$i<$jsondata;$i++){
     $obj = $jsondata[$i];
    if($obj['id'] == $id){
     $obj['product'] = $product;
     $obj['quantity'] = $quantity;
     $obj['price'] = $price;
     $obj['amount'] = $amount;
     $obj['orderdate'] = $orderdate;
    $jsondata = json_encode($jsondata);
    
    $result = file_put_contents("../../public/products.json",$jsondata);
    if($result) {return $success = "data succesfully updated";}
    return $success = "data not saved into json file";
    
}
}
}
}

function deleteproduct($id){
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
$jsondata = file_get_contents("../../public/products.json");
$jsondata = json_decode($jsondata,true);
$jsondata = count($jsondata);
for($i=0;$i<$jsondata;$i++){
  $obj = $jsondata[$i]; 
 if($obj['id']==$id){
 $key = array_search($obj,$jsondata);
 array_splice($jsondata,$key,$i);
 json_encode($jsondata);
 $result = file_put_contents("../../public/products.json",$jsondata);
 if($result) {return  $success ="data successfully deleted";}
 return $success = " No file was deleted ";
 }
}
}
}

?>
