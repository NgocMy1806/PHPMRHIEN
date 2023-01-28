
<?php
$username = 'root';
$password="";
$conn = new PDO ('mysql:host=localhost;dbname=product_management',$username,$password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id= $_GET['id'];
//var_dump($id);die;
$sql = 'DELETE FROM products WHERE id=';
$sql .=$id;
$url='Location:my_lesson9.php';
try{
$sqlDelete=$conn->query($sql);
$url.='?success='.'Delete successfully';
}
catch (PDOException $e){
    $url.='?error='.$e->getMessage();
}
header($url);