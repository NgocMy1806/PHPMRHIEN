<?php
$username = 'root';
$password = "";
$conn = new PDO('mysql:host=localhost;dbname=product_management', $username, $password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//$query=$conn->query('select * from products');

$sortKey = isset($_GET['sortKey']) ? $_GET['sortKey'] : 'id';
// echo $sortKey;
//print_r($_POST['sort1']);

$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';
//echo $sortOrder;

$url = $_SERVER['REQUEST_URI'];
//echo $url;

// Remove specific parameter from query string
if (isset($_GET['sortOrder'])) {
  $key = 'sortOrder';
  $filteredURL = preg_replace('~(\?|&)' . $key . '=[^&]*~', '$1', $url);
  // echo $filteredURL;die;
} else {
  $filteredURL = $url . '&';
}

$sql = 'SELECT p.*, c.name as category, b.name as brand ';
$sql .= 'FROM products p ';
$sql .= 'JOIN categories c ON p.category_id = c.id ';
$sql .= 'JOIN brands b ON p.brand_id = b.id ';
$sql .= 'ORDER BY ' . $sortKey . ' ' . $sortOrder;

$query = $conn->query($sql);
$products = $query->fetchAll();

// echo "<pre>";
// print_r($products);
// echo "</pre>";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <?php if (isset($_GET['error'])) : ?>
      <div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])) : ?>
      <div class="alert alert-success"><?php echo $_GET['success'] ?></div>
    <?php endif; ?>
    <a href="insert_product.php" class="btn btn-outline-dark mb-3">Add new</a>
    <select name="sort1" id="sort1" onchange="location = this.value;">
      <option value="my_lesson9.php?sortKey=p.id">ID</a> </option>
      <option value="my_lesson9.php?sortKey=p.name" <?php if (isset($_GET['sortKey']) && $_GET['sortKey'] == 'p.name') {
                                                      echo "selected";
                                                    } ?>>Name</option>
      <option value="my_lesson9.php?sortKey=p.price" <?php if (isset($_GET['sortKey']) && $_GET['sortKey'] == 'p.price') {
                                                        echo "selected";
                                                      } ?>>Price</option>
    </select>

    <select name="sort2" id="sort2" onchange="location = this.value;">
      <option value="<?php echo $filteredURL; ?>sortOrder=ASC">ASC</a> </option>
      <option value="<?php echo $filteredURL; ?>sortOrder=DESC" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == 'DESC') {
                                                                  echo "selected";
                                                                } ?>>DESC</option>
    </select>
    <!-- <span  <?php  ?>><a href="<?php echo $filteredURL; ?>sortOrder=ASC">ASC</a></span>
        <span  <?php  ?>><a href="<?php echo $filteredURL; ?>sortOrder=DESC">DESC</a></span> -->


    <table class="table table-dark table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">brand</th>
          <th scope="col">category</th>
          <th scope="col">amount</th>
          <th scope="col">price</th>
          <!-- <th scope="col">tag</th> -->
          <th scope="col">create date</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product) : {
          }
        ?>

          <tr>
            <th scope="row"><?php echo $product->id ?></th>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->brand ?></td>
            <td><?php echo $product->category ?></td>
            <td><?php echo $product->amount ?></td>
            <td><?php echo $product->price ?></td>
            <!-- <td><?php echo $product->tag ?></td> -->
            <td><?php echo $product->create_at ?></td>
            <td>
              <a href="edit_product.php?id=<?php echo $product->id; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
              <a data-toggle="modal" href="#modal"><i class="fa-solid fa-trash-can"></i></a>
            </td>

          </tr>



        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


  <div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a type="button" class="btn btn-primary" href="del_data.php?id=<?php echo $product->id; ?>">Delete</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>