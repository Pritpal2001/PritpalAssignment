<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
      <!-- Pritpal Singh 202101071-->

</head>
<style>
   .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 200px;}
  </style>
 <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
<body>
    <header>
        <h1> STARBUCKS MENU</h1>
      <nav class="main">
        <ol>
          <li class="sign"><a href="index.php">Home</a></li>
          <li class="sign"><a href="menu.php">Menu</a></li>
          <li class="sign"><a href="explore.php">Explore</a></li>
          <li class="sign"><a href="me.html">Me</a></li>
           <li class="sign"><a href="resources.html"> Resources</a></li>
          </ol>
      </nav>
      </header>
      <div class="information">
       <section class="container">
       
        <h2>Hot Coffee</h2>
        <p>There are several specialty hot coffee drinks available at Starbucks, including espressos, lattes, cappuccinos,
           and macchiatos. The last three of these can be customized according to the fat content of the milk and the number
            of shots of espresso used, and whether or not they contain caffeine.</p>
        <h2>Iced Coffee</h2>
        <p>In contrast, iced coffee usually involves a specific ration of coffee to water ratio since you are
           diluting the coffee with ice. The gold standard for Starbucks® Iced Coffee is double strength–4 tablespoons 
           of coffee for every 6 fluid ounces-poured over ice.
        </p>
        </section>
        <section>
          <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://images.unsplash.com/photo-1542729779-11d8fe8e25f6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8c3RhcmJ1Y2t8ZW58MHx8MHx8fDA%3D">
          </section>
        </div>
        <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h1 class="pull-left">orders detail</h1>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM orders";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>order_name</th>";
                            echo "<th>ingredients</th>";
                            echo "<th>price</th>";
                            echo "<th>action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['order_name'] . "</td>";
                                echo "<td>" . $row['ingredients'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                 echo "<td>";
                                 echo '<a href="order.php?id=' . $row['id'] . '" class="mr-3" title="order this" data-toggle="tooltip"><span class="fa fa-coffee"></span></a>';
                                 echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
                <a href="create.php" ><i class=" fa fa-plus-circle"></i> Add New order</a>
 </div>
        </div>
    </div>
</body>
</html>