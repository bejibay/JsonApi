
//declare variables
var xhr, obj, table, text, product, quantity, price, amount, orderdate,parsejson;


// send request to functions.php using Ajax
// send request to functions.php to create a new product

function createProduct(){
       
    product = document.getElementById ("product").value;
    quantity = document.getElementById ("quantity").value;
    price = document.getElementById ("price").value;
    amount = quantity*price;
    document.getElementById ("amount").value = amount;
    orderdate =  document.getElementById ("orderdate").value;
    xhr= new XMLHttpRequest();
    xhr.onload=function(){
    obj= this.responseText;}
    xhr.open("POST", "http://localhost/JsonApi/src/controller/functions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('product=' +product +'&quantity='+quantity+ '& price='+price+ '&amount=' +amount+ '&orderdate='+ 
    orderdate+'&create='+1);
    
                                                                        
}

//request data from functions.php file using ajax 
//use ajax get method to receive all data from the json store


function listProducts(){
    xhr= new XMLHttpRequest();
    xhr.onload = function(){
    obj= this.responseText;}
    
    xhr.open( "GET", "http://localhost/JsonApi/src/controller/functions.php", true);
    xhr.send();
    
    //convert json array string data to Javascript object
    
    parsejson = JSON.parse(obj);
    table='<table>';
    table+="<tr><th>Product Name</th><th><Product Quantity</th><th>Price</th><th>Amount</th><th>Date</th><th>Action</th></tr>";
    for(i=0; i< parsejson.length; i++){
    text=parsejson[i];
    table+="<tr><td>text.product</td><td>text.quantity</td><td>text.price</td><td>text.amount</td><td>text.orderdate</td>";
    table+="<td><button type ='button' onClick = 'editProduct(+text.id+)'>Edit</button><button type ='button' onclick ='deleteProduct(+text.id+)'>Delete</button>";
    table+="</td></tr>";
    }
    table+="</table>";
    document.getElementById ("listproducts").innerHTML=table;
    }
    

// send request to functions.php udsimg Ajax
// send request to functions.php to retrieve info on a product


function editProduct(id){
    xhr= new XMLHttpRequest();
    xhr.onload=function(){
    obj= this.responseText;}

    xhr.open( 'GET', 'http://localhost/JsonApi/src/controller/functions.php?edit='+id, true);
    xhr.send();

    
    //convert json array string data to Javascript object
    
    parsejson= JSON.parse(obj);
    for(let x in parsejson){
    document.getElementById ("id").innerHTML=parsejson['id'];
    document.getElementById ("product").innerHTML=parsejson['product'];
    document.getElementById ("quantity").innerHTML=parsejson['quantity'];
    document.getElementById ("price").innerHTML=parsejson['price'];
    document.getElementById ("amount").innerHTML=parsejson['amount'];
    document.getElementById ("orderdate").innerHTML=parsejson['orderdate'];

    }
}


// send request to functions,php udsimg Ajax
// send request to functions,php to update a new product

    
function updateProduct(){
    xhr = new XMLHttpRequest();
    xhr.onload = function(){
    obj = this.responseText;
     }
      
    id =document.getElementById('id').value;
    product =document.getElementById('product').value;
    quantity =document.getElementById('quantity').value;
    price =document.getElementById('price').value;
    orderdate =document.getElementById('orderdate').value;
    amount =document.getElementById('amount').value;
    xhr.open('PUT',"http://localhost/JsonApi/src/controller/functions.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.send('id='+id + '&product='+product +'&quanty='+quantity +'&price='+price +'&orderdate='+orderdate +'&amount='+amount+'&update='+1);
    }


// send request to functions,php udsimg Ajax
// send request to functions,php to delete a new product


    function deleteProduct(id){
    xhr= new XMLHttpRequest();
    xhr.onload=function(){
    obj= this.responseText;}
    xhr.open( 'GET', 'http://localhost/JsonApi/src/controller/functions.php?delete='+id, true);
    xhr.send();
    
    
    }

    

    


    