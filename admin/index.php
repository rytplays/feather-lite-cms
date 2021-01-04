<?php
    session_start();
    session_unset();

    require_once("../config.php");

    if(isset($_COOKIE["password"]))
    {
        if($_COOKIE["password"]==ADMIN_PASSWORD)
        {
            $_SESSION["admin"]=true;
            header("Location:dashboard/");
        }
    }

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $error="";
        if(!empty($_POST["password"]))
        {
            if($_POST["password"]==ADMIN_PASSWORD)
            {
                $_SESSION["admin"]=true;
                setcookie("password",$_POST["password"],time()+(86400*30),"/");
                header("Location:dashboard/");
            }
            else
            {
                $error="password is incorrect";
            }
        }
        else
        {
            $error="password is empty";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
</head>
<body>
    
    <?php if(isset($error))
    {
        echo "<div class='alert alert-warning'>".$error."</div>";
    }?>

    <div class="p-3">
        <form class="mx-auto text-center card" style="max-width:300px;" action="index.php" method="post">
            <h3 class="card-header">LOGIN</h3>
            <div class="card-body">
                <input required class="form-control" type="text" name="password" placeholder="enter password" value="<?php echo $_COOKIE["password"] ?? ''; ?>">
            </div>
            <button class="btn btn-primary btn-block mt-2" type="submit">LOGIN</button>
        </form>
    </div>

</body>
</html>