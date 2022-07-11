<?php
    include_once 'includes/header.php';
    include_once 'includes/dbcon.php';
    include_once 'includes/PHPExcel.php';
    include_once 'includes/PHPExcel/IOFactory.php';
    if($_SESSION['type']!=="admin")
    {
        exit(" Error:You must login as admin to view this page.");
    }

    if(isset($_POST["submit"]))
{
    $file=$_FILES["sheetfile"]["tmp_name"];

    $obj=PHPExcel_IOFactory::load($file);

    foreach($obj->getWorksheetIterator() as $sheet)
    {
        $getHighestRow=$sheet->getHighestRow();
        for($i=2;$i<=$getHighestRow;$i++)
        {
            $name=$sheet->getCellByColumnAndRow(0,$i)->getValue();
            $prn=$sheet->getCellByColumnAndRow(1,$i)->getValue();
            $email=$sheet->getCellByColumnAndRow(2,$i)->getValue();

            mysqli_query($con,"insert into student(name,prn,email,password) values('$name','$prn','$email','$prn')");
        }
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

    <title>Upload List</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            <li class="nav-item">
          <a class="nav-link " href="admin.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="uploadlist.php">Upload list</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
            </ul>
        </div>
    </nav>

    <div style=" padding:25px;">
        <form  method="post" enctype="multipart/form-data" action="uploadlist.php" class=" p-4 bg-light border" style=" margin:auto ; width: 400px;">
      
            <div class="mb-3 fs-2 text-center">Upload List</div>
           
            <div class="mb-3">
            <input type="file" name="sheetfile"  accept=".xml,.xlsx" required >
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>


</body>

</html>