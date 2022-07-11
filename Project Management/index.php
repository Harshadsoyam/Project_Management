<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';


if(isset($_POST["submit"]))
{
    $type=mysqli_real_escape_string($con,$_POST["type"]);
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $pwd=$_POST["password"];

    
    $sql="SELECT *FROM $type WHERE email ='$email'";
    $result=mysqli_query($con,$sql);
    $use =mysqli_fetch_assoc($result);

    if($use)
    {
        if($use["password"] ===$pwd )
        {
            $_SESSION["id"]=$use["id"];
            $_SESSION["type"]=$type;
            header("location:$type.php");
        }
        else
        {
            $_SESSION["message"]="Wrong Password";
        }
    }
    else
    {
        $_SESSION["message"]="Username does not exists";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <title>Login</title>
</head>

<body>
    
<div class="container-fluid">
    <form
        action="index.php"
        method="post"
        style="width: 400px"
        class="p-4 bg-light border position-absolute top-50 start-50 translate-middle"
      >
        <div class="mb-3 fs-2 text-center">Login</div>
        <div class="inf"><?= $_SESSION['message'] ?></div><br>
        <label for="type" style="color: white;">Log In as : </label>
        <input type="radio" name="type" style="cursor: pointer;" value="admin" required><span>Admin</span>
        <input type="radio" name="type" style="cursor: pointer; margin-left: 5px;" value="faculty" required><span>Faculty</span>
        <input type="radio" name="type" style="cursor: pointer; margin-left: 5px" value="student" required><span>Student</span><br>
    
        <div class="mb-3">
          <label for="exampleInputUsername" class="form-label">Username</label>
          <input
            type="email"
            class="form-control"
            name="email"
            id="exampleInputUsername"
            required
          />
        </div>
        <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            name="password"
            id="exampleInputPassword1"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    </div>
</body>

</html>
