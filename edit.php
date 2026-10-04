<?php
include 'db.php';
session_start();
if (isset($_GET['pid'])) {
    $pid=$_GET['pid'];
    $sql=$conn->prepare("select * from products where pid=?");
    $sql->bind_param("i",$pid);
    $sql->execute();
    $user=$sql->get_result()->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $pid=$_POST["pid"];
    $pname=$_POST["pname"];
    $pcategory=$_POST["pcategory"];
    $pprice=$_POST["pprice"];
    $pquantity=$_POST["pquantity"];
    $sname=$_POST["sname"];

    $sql=$conn->prepare("update products set pname=?,category=?,price=?,quantity=?,sname=? where pid=?");
    $sql->bind_param("ssdisi",$pname,$pcategory,$pprice,$pquantity,$sname,$pid);
    if ($sql->execute()) {
        header("Location:home.php");
        exit();
    } else {
        echo "Error";
    }
}
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <title>Edit Product</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
    <h2 class="text-center">Edit Product</h2>
    <div class="container col-7">
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="pid"
                    id="pid"
                    value="<?= $user['pid']?>"
                    readonly
                />
                <label for="pid">Product ID</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="pname"
                    id="pname"
                    value="<?= $user['pname']?>"
                />
                <label for="pname">Product Name</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="pprice"
                    id="pprice"
                    value="<?= $user['price']?>"
                />
                <label for="pprice">Product Price</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="pcategory"
                    id="pcategory"
                    value="<?= $user['category']?>"
                />
                <label for="pcategory">Product Category</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="pquantity"
                    id="pquantity"
                    value="<?= $user['quantity']?>"
                />
                <label for="pquantity">Product Quantity</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="sname"
                    id="sname"
                    value="<?= $user['sname']?>"
                />
                <label for="sname">Supplier Name</label>
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Edit
            </button>

        </form>

    </div>

</main>

<footer>
    <!-- place footer here -->
</footer>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwxH9J09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"
></script>

</body>
</html>
