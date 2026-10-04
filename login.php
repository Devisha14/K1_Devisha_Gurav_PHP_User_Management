<?php
include 'db.php';
session_start();
 if($_SERVER["REQUEST_METHOD"]==="POST")  {
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $name=$_POST["name"];
    $sql=$conn->prepare("select id,password from users where email=?");
    $sql->bind_param("s",$email);
    $sql->execute();
    $sql->bind_result($id,$password);
   $sql->fetch();

   if (password_verify($pass,$password)) {
   $_SESSION['name']=$name; 
   $_SESSION['email']=$email;
    $_SESSION['user_id']=$id;
    header("Location:home.php");
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
            <h2 class="text-center">Login Here..</h2>
       <div
        class="container"
       >

        <form action="" method="POST">
             <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="formId1"
                    placeholder=""
                />
                <label for="formId1">Name</label>
             </div>
             
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="email"
                    id="formId1"
                    placeholder=""
                />
                <label for="formId1">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="pass"
                    id="formId1"
                    placeholder=""
                />
                <label for="formId1">Password</label>
            </div>
            <button
                type="submit"
                class="btn btn-primary"
            >
                Login
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
