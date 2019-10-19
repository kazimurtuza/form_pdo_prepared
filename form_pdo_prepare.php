<!-- -----------------batabase connection ---------------------->
<?php  
  $src="mysql:host=localhost;dbname=form_db";
  $name="root";
  $pass="";

  try{
      $conn= new PDO($src,$name,$pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo"connect";

  }
  catch(PDOException $e)
  {
      echo "NO CONN". $e->getMessage();
  }
?>



<!-- paramiter pass -->
<?php 
$sqq="SELECT * FROM form_tb WHERE id= :id && name= :name";
$realulta=$conn->prepare($sqq);

// $realulta->bindParam(':id',$id);
// $realulta->bindParam(':sallary',$sallary);
// $id= 66;
// $sallary=19992;

$realulta->execute([':id'=>66,':name'=>'kazimurtuza']);
$row=$realulta->fetch(PDO::FETCH_ASSOC);
echo $row['name'];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
   
    <!-----------collect data from table and show  with bind associate prepared -------------->
<?php 
try{
$qui="SELECT * FROM form_tb";
$result=$conn->prepare($qui);
$result->execute();

//////////bind by column ASSOCIATE//////////////////

$result->bindColumn('id',$id);
$result->bindColumn('name',$name);
$result->bindColumn('phon',$phon);
$result->bindColumn('country',$country);
$result->bindColumn('sallary',$sallary);

// $rownum=$result->rowCount();
// echo $rownum;
echo"<div class='container'>";
echo"<div class='row' style='background:rgba(0, 123, 255, 0.46);'>";
echo"<div class='col-sm-4' >";


  if($result->rowCount()>0)
{
    echo"<table class='table'>";
    echo"<thead>";  
    echo"<tr>";
    echo"<th>"."id"."<th/>";
    echo"<th>"."name"."<th/>";
    echo"<th>"."phon"."<th/>";
    echo"<th>"."country"."<th/>";
    echo"<th>"."sallary"."<th/>";
    echo"<th>"." option"."<th/>";
    echo"</tr>";
    echo"<thead>";  
    echo"<tbody>";
    while($result->fetch(PDO::FETCH_ASSOC))
    {
      echo"<tr>";
      echo"<td>".$id."<td/>";
      echo"<td>".$name."<td/>";
      echo"<td>".$phon."<td/>";
      echo"<td>".$country."<td/>";
      echo"<td>".$sallary."<td/>";
      echo"<td>
      <form method='POST'>
       <input type='hidden' name='id' value='$id'>
       <input type='submit' name='update' value='update' class='btn btn-success'>
      </form>
      <td/>";

      echo"<td>
      <form method='POST'>
       <input type='hidden' name='id' value='$id'>
       <input type='submit' name='delete' value='delete' class='btn btn-danger'>
      </form>
      <td/>";
      echo"</tr>";

    }
    echo"<tbody>";
    echo"</table>";
}
}


catch(PDOException $e)
{
  echo $e->getMessage();
}
echo"</div>";
echo"</div>";
echo"</div>";

// close prepared statement
unset($result);

?>
<!-- ------------------------------delete data------------------------------ -->
<?php 
if(isset($_REQUEST['delete']))
{
$quedele="DELETE From form_tb WHERE id = :id";
$resultdele=$conn->prepare($quedele);
$resultdele->bindParam(':id',$id);
$id=$_REQUEST['id'];
$resultdele->execute();
// close prepared statement
unset($resultdele);
}
?>


<!-------------------------------- updte value --------------------------- -->
<?php 

if(isset($_REQUEST['update']))
{

echo $_REQUEST['id'];
$quire="SELECT * FROM form_tb WHERE id = :id";
$setres=$conn->prepare($quire);
  $setres->bindParam(':id',$id);
  $id=$_REQUEST['id'];
  $setres->execute();
  $row=$setres->fetch(PDO::FETCH_ASSOC);

unset($setres);
}
?>
<!-- ----------------------------------update form ------------------------------------>
<div class="container">
<div class="row">
<div class="col-sm-4">

<form action="" method="POST">
 <div class="form-group">
 <label for="">name</label>
 <input type="text" value="<?php if(isset($row['name'])){echo $row['name'];} ?>" name="name" class="form-control">
 </div>
 <div class="form-group">
 <label for="">phon</label>
 <input type="text"value="<?php if(isset($row['phon'])){echo $row['phon'];} ?>" name="phon" class="form-control">
 </div>
 <div class="form-group">
 <label for="">country</label>
 <input type="text"value="<?php if(isset($row['country'])){echo $row['country'];} ?>" name="country"             class="form-control">
 </div> 
 <div class="form-group">
 <label for="">sallary</label>
 <input type="text"value="<?php if(isset($row['sallary'])){echo $row['sallary'];} ?>" name="sallary" class="form-control">
 </div>

 <input type="hidden" name="id" value="<?php if(isset($row['id'])){echo $row['id'];} ?>">
 <input type="submit" name="recover" value="recover" class="btn btn-info">

</form>
</div>
</div>
</div>

 <!-- ---------------------------update php code ------------------------------->
<?php 
try{
if(isset($_REQUEST['recover']))
{
echo "recover";
$quech="UPDATE form_tb SET name = :name,phon =:phon , country = :country,sallary=:sallary WHERE id= :id";
$resultch=$conn->prepare($quech);
$resultch->bindParam(':name',$name,PDO::PARAM_STR);
$resultch->bindParam(':phon',$phon);
$resultch->bindParam(':country',$country,PDO::PARAM_STR);
$resultch->bindParam(':sallary',$sallary,PDO::PARAM_STR);
$resultch->bindParam(':id',$id,PDO::PARAM_INT);


  $name=$_REQUEST['name'];
  $country=$_REQUEST['country'];
  $phon=$_REQUEST['phon'];
  $sallary=$_REQUEST['sallary'];
  $id=$_REQUEST['id'];
  $resultch->execute();
}
}
catch(PDOException $e)
{
  echo $e->getMessage();
}
?>
<!-- ----------------------insert form---------------------------->
<div class="container">
<div class="row">
<div class="col-sm-4">

<form action="" method="POST">
 <div class="form-group">
 <label for="">name</label>
 <input type="text" value="" name="name" class="form-control">
 </div>
 <div class="form-group">
 <label for="">phon</label>
 <input type="text"value="" name="phon" class="form-control">
 </div>
 <div class="form-group">
 <label for="">country</label>
 <input type="text"value="" name="country"             class="form-control">
 </div> 
 <div class="form-group">
 <label for="">sallary</label>
 <input type="text"value="" name="sallary" class="form-control">
 </div>


 <input type="submit" name="insert" value="insert" class="btn btn-mute">

</form>
</div>
</div>
</div>

<!----------------------- insert value ---------------------------->
<?php 
if(isset($_REQUEST['insert']))
{
  if(($_REQUEST['name'] == "" )|| ($_REQUEST['phon'] == "") || ($_REQUEST['country']  == "") ||  ($_REQUEST['sallary']  == "")){
    echo "fillup all data";
  }
  else{
  $insque="INSERT INTO form_tb (name,phon,country,sallary) VALUE(:name,:phon,:country,:sallary)";
  $resultin=$conn->prepare($insque);

    $resultin->bindParam(':name',$name);
    $resultin->bindParam(':phon',$phon);
    $resultin->bindParam(':country',$country);
    $resultin->bindParam(':sallary',$sallary);
    $name=$_REQUEST['name'];
    $phon=$_REQUEST['phon'];
    $country=$_REQUEST['country'];
    $sallary=$_REQUEST['sallary'];

    $resultin->execute();
    unset($resultin);   
}
}

?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php 


// close connection
$conn=null;
?>