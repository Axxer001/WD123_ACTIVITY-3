<!DOCTYPE html>
<?php
//Variable initializations in PHP
$product_name = "";
$product_name_error = "";

$category = "";

$price = "";
$price_error = "";

$stock_quantity = "";
$stock_quantity_error = "";

$expiration_date = "";
$expiration_date_error = "";

$status = "";
$status_error = "";

// The main validation block
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation for Product Name
    if (empty($_POST["product_name"])) {
        $product_name_error = "Product name is required";
    } else {
        $product_name = trim(htmlspecialchars($_POST["product_name"]));
    }

    // Validation for Category
    if (!empty($_POST["category"])) {
        $category = htmlspecialchars($_POST["category"]);
    }

    // Validation for Price (No. 2 from the previous task)
    if (empty($_POST["price"])) {
        $price_error = "Price is required.";
    } elseif (!is_numeric($_POST["price"])) {
        $price_error = "Price must be a number.";
    } elseif ($_POST["price"] <= 0) {
        $price_error = "Price can't be zero or negative.";
    } else {
        $price = trim(htmlspecialchars($_POST["price"]));
    }
    
    // Validation for Stock Quantity (Similar to Price but must be a non-negative integer)
    if (empty($_POST["stock_quantity"])) {
        $stock_quantity_error = "Stock quantity is required.";
    } elseif (!ctype_digit($_POST["stock_quantity"])) {
        $stock_quantity_error = "Stock quantity must be a whole number.";
    } elseif ($_POST["stock_quantity"] < 0) {
        $stock_quantity_error = "Stock quantity can't be negative.";
    } else {
        $stock_quantity = trim(htmlspecialchars($_POST["stock_quantity"]));
    }

    // Validation for Expiration Date (No. 4 from the previous task)
    if (empty($_POST["expiration_date"])) {
        $expiration_date_error = "Expiration date is required.";
    } elseif (strtotime($_POST["expiration_date"]) < strtotime(date("Y-m-d"))) {
        $expiration_date_error = "Expiration date can't be in the past.";
    } else {
        $expiration_date = htmlspecialchars($_POST["expiration_date"]);
    }
    
    // Validation for Status (No. 5 from the previous task)
    if (empty($_POST["status"])) {
        $status_error = "Status is required.";
    } else {
        $status = htmlspecialchars($_POST["status"]);
    }

    // If there are no errors, redirect or process the data
    if (empty($product_name_error) && empty($price_error) && empty($stock_quantity_error) && empty($expiration_date_error) && empty($status_error)) {
        header("Location: redirect.php");
        // exit;
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .error {
            color: red;
            margin: 0;
        }
    </style>
</head>
<body>
    <img src="Nexon-Logo.wine.png" alt="Nexon Logo" style="display: block; margin: 0 auto; max-width: 250px;">
    <!-- In method="get", the URL changes to http://localhost/newproj/index.php?product_name=mine&category=Category+B&price=123&stock_quantity=12&expiration_date=2025-09-04&status=active
     while in method="post", the URL stays as is after filling up the form and then clicking submit-->
    <form action="" method="post">
        <label>Product Name: </label><br>
        <input type="text" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>"><br>
        <p class="error">* <?php echo $product_name_error; ?></p>
        
        <select name="category">
            <option value="">-- Select Category --</option>
            <option value="Category A" <?php echo ($category == "Category A") ? "selected" : ""; ?>>Category A</option>
            <option value="Category B" <?php echo ($category == "Category B") ? "selected" : ""; ?>>Category B</option>
            <option value="Category C" <?php echo ($category == "Category C") ? "selected" : ""; ?>>Category C</option>
            <option value="Category D" <?php echo ($category == "Category D") ? "selected" : ""; ?>>Category D</option>
        </select>

        <label>Price (&#8369): </label>
        <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($price); ?>"><br>
        <p class="error">* <?php echo $price_error; ?></p>
        
        <label>Stock Quantity: </label>
        <input type="number" name="stock_quantity" value="<?php echo htmlspecialchars($stock_quantity); ?>"><br>
        <p class="error">* <?php echo $stock_quantity_error; ?></p>
        
        <label>Expiration Date: </label><br>
        <input type="date" name="expiration_date" value="<?php echo htmlspecialchars($expiration_date); ?>"><br>
        <p class="error">* <?php echo $expiration_date_error; ?></p>
        
        <label>Status: </label><br>
        <input type="radio" name="status" value="active" <?php echo ($status == 'active') ? 'checked' : ''; ?>> Active
        <input type="radio" name="status" value="inactive" <?php echo ($status == 'inactive') ? 'checked' : ''; ?>> Inactive<br>
        <p class="error">* <?php echo $status_error; ?></p>
        
        <!-- 5. It asks me to fill out the form when I try to submit without inputting anything -->
        <!-- Unless the inputs doesn't contain a 'required' statement, it won't accept empty values -->
        <!-- The input does not allow typing of letters on a number-expected input -->
        <!-- The submition accepts the data that doesn't contain a date or a valid present date -->
        <input type="submit" value="Save Product">
    </form>
</body>
</html>