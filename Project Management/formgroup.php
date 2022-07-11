<?php
    include_once 'includes/header.php';
    include_once 'includes/dbcon.php';
    if($_SESSION['type']!=="student")
    {
        exit("You must login as student to view this page");
    }

    if(isset($_POST["submit"]))
    {
        $groupleaderPRN=mysqli_real_escape_string($con,$_POST["groupleaderPRN"]);
        foreach($_POST["groupmembers"] as $members)
        {
            mysqli_query($con,"Update student set projectgroup='$groupleaderPRN' Where prn='$members'");
        }
    
        }

    $sql="SELECT name,prn FROM student where projectgroup=''";
    $result=mysqli_query($con,$sql);
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
          <a class="nav-link " href="student.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="formgroup.php">Form group</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
    </nav>
    <div style=" padding:25px;">
        <form  method="post" enctype="multipart/form-data" action="formgroup.php" class=" p-4 bg-light border" style=" margin:auto ; width: 400px;">
      
            <div class="mb-3 fs-2 text-center">Select Members</div>
           
            <div class="mb-3">
                <input type="text" name="groupleaderPRN" required placeholder="Group Leader PRN">
            </div>
            <div class="mb-3">
            <?php
                
                echo"<select name='groupmembers[]' multiple>";
                while($row=mysqli_fetch_row($result))
                {
                    echo"
                        <option value='$row[1]'>$row[0] $row[1]
                        </option>"; 
                }
            echo"</select>"
            
            ?>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
  
</body>

</html>
