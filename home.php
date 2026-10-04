<?php
include "db.php";
session_start();
if(!isset($_SESSION["uid"])){
    header("Location:login.php");
}

$uid=$_SESSION["uid"];
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $pname=$_POST["pname"];
    $category=$_POST["category"];
    $price=$_POST["price"];
    $quantity=$_POST["quantity"];
    $sname=$_POST["sname"];
   // $uid=$_SESSION["uid"];
    $sql=$conn->prepare("insert into products (pname,category,price,quantity,sname,uid) values(?,?,?,?,?,?)");
    $sql->bind_param("ssdisi",$pname,$category,$price,$quantity,$sname,$uid);
    if($sql->execute()){
         echo "
        <script>
        alert('Product Added Succesfully');
        window.location.href='home.php';
        </script>";
    
    }
    else{
        echo "
        <script>
        alert('Product Not Added');
        </script>";
    }
}

$sql=$conn->prepare("select pid, pname, category,price,quantity,sname from products where uid=?");
$sql->bind_param("i",$uid);
$sql->execute();
$result=$sql->get_result();

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
             <nav
                class="navbar navbar-expand-sm navbar-dark bg-dark"
             >
                <div class="container">
                    <a class="navbar-brand" href="#"><?php  echo "HELLO, ".$_SESSION["name"]; ?></a>
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="home.php" aria-current="page"
                                    >Home
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
</ul>
                         
                            
                        
                       
                        <form class="d-flex my-2 my-lg-0">
                            <a
                                name=""
                                id=""
                                class="btn btn-primary"
                                href="pdf.php"
                                role="button"
                                >Generate PDF</a
                            >
                            
                        </form>    
                        
                        <form class="d-flex my-2 my-lg-0 ms-4">
                            <a
                                name=""
                                id=""
                                class="btn btn-primary"
                                href="logout.php"
                                role="button"
                                >Logout</a
                            >
                            
                        </form>   
                        
                       
                    </div>
                </div>
             </nav>
             
        </header>
         <main>
            <h1 class ="text-center mt-4"> ADD PRODUCTS!!</h1>
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
            <h1 class="text-center mt-4"> MY PRODUCTS </h1>
            <div
                class="table-responsive"
            >
                <table
                    class="table table-primary"
                >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Supplier's Name</th>
                            
                            <th scope="col">Action</th>
                            <th scope="col">Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row=$result->fetch_assoc()){?>
                        <tr class="">
                            <td scope="row"><?php echo $row["pid"]; ?></td>
                            <td scope="row"><?php echo $row["pname"]; ?></td>
                            <td scope="row"><?php echo $row["category"]; ?></td>
                            <td scope="row"><?php echo $row["price"]; ?></td>
                            <td scope="row"><?php echo $row["quantity"]; ?></td>
                            <td scope="row"><?php echo $row["sname"]; ?></td>
                            <td>
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="edit.php?pid=<?php echo $row["pid"];?>"
                                    role="button"
                                    >EDIT</a
                                >
                                
                            </td>
                            <td>
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="delete.php?pid=<?php echo $row["pid"];?>"
                                    role="button"
                                    onclick="return confirm('Do you really want to delete this product?')"
                                    >DELETE</a
                                >
                                
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
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
