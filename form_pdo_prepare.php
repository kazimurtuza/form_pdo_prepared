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



<!-- ----------------collect data from table with bind associate prepared ----------------->
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

while($result->fetch(PDO::FETCH_ASSOC))
{
  echo " id :".$id.", name :".$name.", phon :".$phon.", country :".$country.", sallary  : ".$sallary."<br/><br/>";
}


}
catch(PDOException $e)
{
  echo $e->getMessage();
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








<?php 
// close prepared statement
unset($result);

// close connection
$conn=null;
?>