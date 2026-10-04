<?php
include "db.php";
session_start();
$user_id = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $name=$_POST["pname"];
    $category=$_POST["pcategory"];
    $pprice=$_POST["pprice"];
    $pquantity=$_POST["pquantity"];
    $sname=$_POST["sname"];

    $sql=$conn->prepare("insert into products(pname,category,price,quantity,sname,user_id) values(?,?,?,?,?,?)");

    $sql->bind_param("ssdisi",$name,$category,$pprice,$pquantity,$sname,$user_id);

    if ($sql->execute()) {
        header("Location:home.php");
        exit();
    }
}

$sql=$conn->prepare("select * from products where user_id=?");
$sql->bind_param("i",$user_id);
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
           <nav
            class="navbar navbar-expand-sm navbar-light bg-light"
           >
            <a class="navbar-brand" href="#">Hello,<?php echo $_SESSION['name']; ?></a>
            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation"
            ></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page"
                            >Home <span class="visually-hidden">(current)</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="dropdownId"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >Dropdown</a
                        >
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0" action="logout.php">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        Logout
                    </button>
                </form>
                <form class="d-flex my-2 my-lg-0" action="pdf.php">
                   
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        Generate pdf
                    </button>
                </form>

            </div>
           </nav>
           
        </header>
        <main>
            <h2 class="text-center p-4">Add Products</h2>

            <div
                class="container col-7"
            >
                <form action="" method="POST">
   <div class="form-floating mb-3">
    <input
        type="text"
        class="form-control"
        name="pname"
        id="formId1"
        placeholder=""
    />
    <label for="formId1"> Product Name</label>
   </div>
    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control"
            name="pcategory"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Product Category</label>
    </div>
       <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control"
            name="pprice"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Product Price</label>
       </div>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                name="pquantity"
                id="formId1"
                placeholder=""
            />
            <label for="formId1">Product Quantity</label>
        </div>
          <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                name="sname"
                id="formId1"
                placeholder=""
            />
            <label for="formId1">Supplier Name</label>
          </div>
           <button
            type="submit"
            class="btn btn-primary"
           >
            Add Product
           </button>
           

                </form>
            </div>
            <h2 class="text-center">Product Dashboard</h2>
        <div
            class="container"
        >
           <div
            class="table-responsive"
           >
            <table
                class="table table-primary"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                         <th scope="col">Price</th>
                          <th scope="col">Quantity</th>
                           <th scope="col">Supllier Name</th>
                            <th scope="col">Action</th>
                            <th scope="col">Action</th>
                    </tr>
                </thead>
                  <?php while($row=$result->fetch_assoc()){?>
                <tbody>      
           <tr>
            <td><?=$row['pid']?></td>
            <td><?=$row['pname']?></td>
            <td><?=$row['category']?></td>
             <td><?=$row['price']?></td>
            <td><?=$row['quantity']?></td>
            <td><?=$row['sname']?></td>
             <td><a
                        name=""
                        id=""
                        class="btn btn-primary"
                        href="edit.php?pid=<?=$row['pid']?>"
                        role="button"
                        >Edit</a>
                      </td>
                    <td><a
                        name=""
                        id=""
                        class="btn btn-primary"
                        href="delete.php?pid=<?=$row['pid']?>"
                        role="button"
                        onclick="return confirm('Are you sure you want to delete the product?')"                       >Delete</a>
                      </td>
</tr>
<?php }?>
                </tbody>
            </table>
           </div>
           
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
