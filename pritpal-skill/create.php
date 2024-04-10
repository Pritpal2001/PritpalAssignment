
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$order_name = $ingredients = $price = "";
$order_name_err = $ingredients_err = $price_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate order
    $input_order_name = trim($_POST["order_name"]);
    if (empty($input_order_name)) {
        $order_name_err = "Please enter a order detail correctly.";
    } 
    else {
        $order_name= $input_order_name;
    }

    // Validate ingredients
    $input_ingredients = trim($_POST["ingredients"]);
    if (empty($input_ingredients)) {
        $ingredients_err = "Please enter an ingredients.";
    } else {
        $ingredients = $input_ingredients;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the amount.";
    } elseif (!ctype_digit($input_price)) {
        $price_err = "Please enter a positive integer value.";
    } else {
        $price = $input_price;
    }

    // Check input errors before inserting in database
    if (empty($order_name_err) && empty($ingredients_err) && empty($price_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO orders (order_name, ingredients, price) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_order_name, $param_ingredients, $param_price);

            // Set parameters
            $param_order_name = $order_name;
            $param_ingredients = $ingredients;
            $param_price= $price;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: menu.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Order</label>
                            <input type="text" name="order_name" class="form-control <?php echo (!empty($order_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $order_name; ?>">
                            <span class="invalid-feedback"><?php echo $order_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Ingredients</label>
                            <input type="text" name="ingredients"class="form-control <?php echo (!empty($ingredients_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ingredients; ?>">
                            <span class="invalid-feedback"><?php echo $ingredients_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="menu.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
