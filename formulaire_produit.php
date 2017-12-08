<form action="" method="post">
    <label for="username">name</label><br>
    <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>"><br>
    <label for="username">category</label><br>
    <input type="text" name="category" id="category" value="<?php if(isset($_POST['category'])){echo $_POST['category'];} ?>"><br>
    <label for="username">brand</label><br>
    <input type="text" name="brand" id="brand" value="<?php if(isset($_POST['brand'])){echo $_POST['brand'];} ?>"><br>
    <label for="username">price</label><br>
    <input type="text" name="price" id="price" value="<?php if(isset($_POST['price'])){echo $_POST['price'];} ?>"><br>
    <label for="username">status</label><br>
    <input type="text" name="status" id="status" value="<?php if(isset($_POST['status'])){echo $_POST['status'];} ?>"><br>
    <label for="username">description</label><br>
    <input type="text" name="description" id="description" value="<?php if(isset($_POST['description'])){echo $_POST['description'];} ?>"><br>
    <label for="username">receipt</label><br>
    <input type="text" name="receipt" id="receipt" value="<?php if(isset($_POST['receipt'])){echo $_POST['receipt'];} ?>"><br>
    <label for="username">warrantly</label><br>
    <input type="text" name="warrantly" id="warrantly" value="<?php if(isset($_POST['warrantly'])){echo $_POST['warrantly'];} ?>"><br>
    <label for="username">purchase_date</label><br>
    <input type="text" name="purchase_date" id="purchase_date" value="<?php if(isset($_POST['purchase_date'])){echo $_POST['purchase_date'];} ?>"><br>
    <label for="username">delivery</label><br>
    <input type="text" name="delivery" id="delivery" value="<?php if(isset($_POST['delivery'])){echo $_POST['delivery'];} ?>"><br>
<?php
    $request = $db->prepare("INSERT INTO user VALUES (NULL, :name, :category, :brand, :price, :status, :description,
    :receipt, :warrantly, :purchase_date, :delivery)");
    $sending = $request->execute([
    ':name' => $_POST['name'],
    ':category' => $_POST['category'],
    ':brand' => $_POST['brand'],
    ':price' => $_POST['price'],
    ':status' => $_POST['status'],
    ':description' => $_POST['description'],
    ':receipt' => $_POST['receipt'],
    ':warrantly' => $_POST['warrantly'],
    ':purchase_date' => $_POST['purchase_date'],
    ':delivery' => $_POST['delivery']

    ]);

?>


</form>