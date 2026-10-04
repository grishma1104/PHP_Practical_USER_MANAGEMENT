<?php
include "db.php";
session_start();
$uid=$_SESSION["uid"];
if(isset($_GET["pid"])){
    $pid=$_GET["pid"];
$sql=$conn->prepare("select pname, category,price,quantity,sname from products where pid=? and uid=?");
$sql->bind_param("ii",$pid,$uid);
$sql->execute();
$result=$sql->get_result();
$row=$result->fetch_assoc();
if(!$row){
    echo "<script>
        alert ('Product Not Found');
        </script>";
}
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $pname=$_POST["pname"];
    $category=$_POST["category"];
    $price=$_POST["price"];
    $quantity=$_POST["quantity"];
    $sname=$_POST["sname"];
    $uid=$_SESSION["uid"];
    $sql=$conn->prepare("update products set pname=?,category=?,price=?,quantity=?,sname=?,uid=?");
    $sql->bind_param("ssdisi",$pname,$category,$price,$quantity,$sname,$uid);
    if($sql->execute()){
         echo "
        <script>
        alert('Product Updated Succesfully');
        window.location.href='home.php';
        </script>";
    
    }
    else{
        echo "
        <script>
        alert('Product Not Updated');
        </script>";
    }
}

?>






<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <h1 class ="text-center mt-4"> UPDATE PRODUCTS!!</h1>
            <div
                class="container col-5 border rounded shadow mt-5 p-5"
            >
                <form action="" method="Post">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="pname"
                            id=""
                            value="<?php echo $row["pname"]; ?>"
                            aria-describedby="helpId"
                            placeholder=""
                        />
                     
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <input
                            type="text"
                            class="form-control"
                            name="category"
                            id=""
                            value="<?php echo $row["category"]; ?>"
                            aria-describedby="emailHelpId"
                            
                        />
                   
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input
                            type="number"
                            class="form-control"
                            name="price"
                            id=""
                            value="<?php echo $row["price"]; ?>"
                            placeholder=""
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input
                            type="text"
                            class="form-control"
                            name="quantity"
                            id=""
                            value="<?php echo $row["quantity"]; ?>"
                            aria-describedby="helpId"
                            placeholder=""
                        />
                     
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Supplier's Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="sname"
                            id=""
                            value="<?php echo $row["sname"]; ?>"
                            aria-describedby="helpId"
                            placeholder=""
                        />
                
                     
                    </div>
                         <button
                        type="submit"
                        class="btn btn-primary"
                     >
                        Submit
                     </button>
                </form>
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
