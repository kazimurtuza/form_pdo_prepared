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
<!-- data collect from bd  with out  bind prepared-->
<?php

// try{
//   $sql="SELECT * FROM form_tb";
//   $result= $conn->prepare($sql);
//   $result->execute();
 
//   while( $row=$result->fetch(PDO::FETCH_ASSOC))
//   {
//   echo "id =".$row['id']."<br/>";
//   echo "name =".$row['name']."<br/>";
//   echo "country =".$row['country']."<br/>";
//   echo "sallary =".$row['sallary']."<br/>";
//   echo"<br/> <br/>";
//   }

// }
// catch(PDOException $w)
// {
//   echo $w->getMessage();
// }

?>


<!-- ----------------collect data from table with bind prepared ----------------->
<?php 
try{
$qui="SELECT * FROM form_tb";
$result=$conn->prepare($qui);
$result->execute();

//////////bind by column number///////////////////

$result->bindColumn(1,$id);
$result->bindColumn(2,$name);
$result->bindColumn(3,$phon);
$result->bindColumn(4,$country);
$result->bindColumn(5,$sallary);

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