<?php
$username = 'root';
$password="";
$conn = new PDO ('mysql:host=localhost;dbname=product_management',$username,$password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$catQuery = $conn->query('SELECT * FROM categories');
$categories = $catQuery->fetchAll();

$brandQuery = $conn->query('SELECT * FROM brands');
$brands = $brandQuery->fetchAll();

//$u=$_GET["id"];
$productEditSql = 'SELECT p.*, c.name as category, b.name as brand ';
$productEditSql .= 'FROM products p ';
$productEditSql .= 'JOIN categories c ON p.category_id = c.id ';
$productEditSql .= 'JOIN brands b ON p.brand_id = b.id ';
$productEditSql .= 'where p.id=';
$productEditSql .= $_GET["id"];
$queryEdit=$conn->query($productEditSql);
$productToEdit=$queryEdit->fetch();
//var_dump($productToEdit);die;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit product</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="edit_data.php" method = "POST">
            <div class="form-group" >
    <label for="exampleInputtext1">name</label>
    <input type="text" name="name" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Enter text" value="<?php echo $productToEdit->name ?>">
</div>

<div class="form-group" >
<label for="exampleInputtext1">select brand</label>
    <select class="custom-select" id="inputGroupSelect04"  name="brand_id">
        <?php foreach ($brands as $brand): ?>
    <option value="<?php echo $brand->id ?>"; <?php if ($brand->id ==$productToEdit->brand_id){echo "selected";};?>><?php echo $brand->name ?></option>
    <?php endforeach ?>
  </select>
</div>

<div class="form-group" >
<label for="exampleInputtext1">select category</label>
    <select class="custom-select" id="inputGroupSelect04" name="category_id" >
    
     <?php foreach ($categories as $category): ?>
    <option value="<?php echo $category->id ?>"; <?php if ($category->id ==$productToEdit->category_id){echo "selected";};?>><?php echo $category->name ?></option>
    <?php endforeach ?>
 
  </select>
</div>

<div class="form-group" >
    <label for="exampleInputtext1">amount</label>
    <input type="text"  name="amount"class="form-control" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Enter text" value="<?php echo $productToEdit->amount ?>">

</div>

<div class="form-group" >
    <label for="exampleInputtext1">price</label>
    <input type="text"  name="price"class="form-control" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Enter text" value="<?php echo $productToEdit->price ?>">
  </div>

  <input type="hidden" id="id" name="id" value="<?php echo $productToEdit->id ?>">

  <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
    
</body>
</html>