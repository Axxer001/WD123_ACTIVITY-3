<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 4.1 Adding the script alert creates a pop-up that says the message presented within the script-->
    <label for="">Product Name: <?php echo htmlspecialchars($_POST["product_name"]);?></label>

    <label>Price (&#8369): <?php echo htmlspecialchars(number_format($_POST["price"], 2));?></label> 

    <label>Stock Quantity: <?php echo htmlspecialchars($_POST["stock_quantity"]);?></label>

    <label>Expiration Date: <?php echo htmlspecialchars(date("M-d-Y", strtotime($_POST["expiration_date"])));?></label><br>
    
    <label>Status: <?php echo htmlspecialchars($_POST["status"]);?></label>
</body>
</html>