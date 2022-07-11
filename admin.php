<?php
    include_once 'includes/header.php';
    include_once 'includes/dbcon.php';
    if($_SESSION['type']!=="admin")
    {
        exit(" Error:You must login as admin to view this page.");
    }

    $sql="SELECT * FROM student ";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_row($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <title>Administrator</title>
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
          <a class="nav-link active" href="admin.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uploadlist.php">Upload list</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div style=" padding:25px;">
    <h4>List Of Students and there Groups :</h4> <br>
            <?php
                
                while($row=mysqli_fetch_row($result))
                {
                    echo" <h5>$row[2] $row[1]  $row[5] </h5>"; 
                }
                ?>
    </div>


</body>

</html>