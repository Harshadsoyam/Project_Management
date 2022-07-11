<?php
    include_once 'includes/header.php';
    include_once 'includes/dbcon.php';
    if($_SESSION['type']!=="student")
    {
        exit("You must login as student to view this page");
    }
    $id=$_SESSION["id"];
    $sql="SELECT projectgroup FROM student where id='$id'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_row($result);
    $projectgroup=$row[0]
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <title>Student Dashboard</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link active" href="student.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="formgroup.php">Form group</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div style=" padding:25px;">

        <h3>Project Group Leader PRN : <?php echo"$projectgroup"?> </h3>
        <h4>Group Members :</h4>
        <?php
            $sql="SELECT name,prn FROM student where projectgroup='$projectgroup' and projectgroup!=''";
            $result=mysqli_query($con,$sql);
            while($row=mysqli_fetch_row($result))
                {
                    echo"
                        <h5>$row[0] $row[1]</h5>"; 
                }
        ?>
    
</div>
</body>

</html>
