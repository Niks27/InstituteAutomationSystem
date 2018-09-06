<?php
require_once("crud6.php");
$crudobj = new crud;

if(isset($_POST['fname']) && $_POST['fname'] != NULL)
{
    $fName = $_POST['fname'];
}

else
{
    $fName = "";
}

$resultArr = $crudobj->getAllStudent($fName);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>

    <title> Student List </title>
    <body>
        <div class="auto-container panel-margin">
            <form action="" method="POST">
                <div class="form-group clearfix">
                <div class="col-sm-4">
                <label class="label-control"> First Name: </label>
                <input type="text" name="fname" class="form-control fname1">
                </div>
                <div class="col-sm-2 clearfix" style="margin-top:20px;">
                <input type="submit" name="submit" value="search" onclick="search()"; class="btn btn-info">
                </div>
                
                <a href="studentdetail.php" class="btn btn-primary" style="margin-top:20px;"> New Student </a>
                </div>
            </form>

            <table class="table table-striped table-bordered table-hover table-responsive">
                <h3 class="text-center"> Student Details </h3>
                    <tr>
                        <th> Student Name </th>
                        <th> Gender </th>
                        <th> Address </th>
                        <th> Mobile Number </th>
                        <th> Batch </th>
                        <th> Fees </th>
                        <th> Action </th>
                    </tr>

                    <?php foreach($resultArr as $key => $value)
                    {?>
                        <tr>
                            <td><?php echo $value['fname']." ".$value['lname'];?></td>
                            <td><?php echo $value['gender'];?></td>
                            <td><?php echo $value['address'];?></td>
                            <td><?php echo $value['mobile'];?></td>
                            <td><?php echo $value['batch'];?></td>
                            <td><?php echo $value['fees'];?></td>
                            <td>
                            <a href="updatestudentdetail.php?id=<?php echo htmlspecialchars($value['id']); ?>" class="btn btn-info"> Update </a>
                            <a href="viewresult.php?id=<?php echo htmlspecialchars($value['id']); ?>" class="btn btn-info"> View Student </a>
                            </td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </body>
</html>