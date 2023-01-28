<?php
$username = 'root';
$password = "";
$conn = new PDO('mysql:host=localhost;dbname=product_management', $username, $password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//var_dump($_POST);die;
//var_dump($_POST['id']);die;
$url = 'Location:my_lesson9.php';
$sql  = 'UPDATE products ';
$sql .= 'SET name=:name, brand_id=:brand_id, category_id=:category_id, amount=:amount, price=:price ';
$sql .= 'WHERE id=:id';
//$sql .= ':id';
$productInsert = $conn->prepare($sql);

try {

  $productInsert->execute([
    'brand_id' => $_POST['brand_id'],
    'name' => $_POST['name'],
    'category_id' => $_POST['category_id'],
    'amount' => $_POST['amount'],
    'price' => $_POST['price'],
    'id' => $_POST['id'],
  ]);

  $url .= '?success=' . 'Update successfully';
} catch (PDOException $e) {
  $url .= '?error=' . $e->getMessage();
}
header($url);
