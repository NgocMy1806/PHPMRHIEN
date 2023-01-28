<?php
$username = 'root';
$password="";
$conn = new PDO ('mysql:host=localhost;dbname=product_management',$username,$password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$url='Location:my_lesson9.php';
$sql  = 'INSERT INTO products ';
$sql .= '(name, brand_id, category_id, amount, price, create_at) ';
$sql .= 'VALUES ';
$sql .= '(:name, :brand_id, :category_id, :amount, :price, :create_at)';
$productInsert = $conn->prepare($sql);

try{

  $productInsert->execute([
    'brand_id' => $_POST['brand_id'],
    'name' => $_POST['name'],
    'category_id' => $_POST['category_id'],
    'amount' => $_POST['amount'],
    'price' => $_POST['price'],
    'create_at' => date('Y-m-d'),
]);
$url.='?success='.'Insert successfully';
}
catch (PDOException $e){
$url.='?error='.$e->getMessage();
}
header($url);
?>

 