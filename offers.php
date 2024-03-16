<?php
include_once("include/conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- aos links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- jquery links -->
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="jquery/jquery.validate.js"></script>

    <link rel="stylesheet" href="guest.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"); -->

    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .error {
            color: red;
        }

        section {
            padding-top: 60px;
            padding-bottom: 60px;
            overflow: hidden;
        }

        .section-bg {
            background-color: #f3f5fa;
            /* background-color: #f6f6f6; */
        }

        .head {
            background-color: rgba(0, 0, 255, 0.867);
            width: 150px;
            height: 2px;
            margin: auto;
            justify-content: center;
            text-align: center;
            align-items: center;
            margin-top: -5px;
        }

        .footer {
            --background-color: #f4f4f4;
            color: var(--default-color);
            background-color: var(--background-color);
            font-size: 14px;
            padding-bottom: 50px;
        }
    </style>
</head>

<body>
    <?php include('header.php')  ?>
    <br>
    <main>
        <section>
            <div class="container bg-light">
                <h1 class="text-center fs-1 fw-bold">Offers</h1>
                <p class="text-center p-2">The top Offers in the company.</p>
                <div class="row">
                    <?php
                    // Assuming you have your database connection established already

                    // Execute the SQL query
                    $sql = "SELECT products.p_id, products.p_name, products.price, products.quantity, products.discount, products.p_image, agency.a_name
                FROM products
                INNER JOIN agency ON products.a_id = agency.a_id
                ORDER BY agency.a_name";
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Initialize an associative array to group products by agency name
                        $groupedProducts = array();

                        // Group products by agency name
                        while ($row = mysqli_fetch_assoc($result)) {
                            $agencyName = $row['a_name'];
                            if (!array_key_exists($agencyName, $groupedProducts)) {
                                $groupedProducts[$agencyName] = array();
                            }
                            $groupedProducts[$agencyName][] = $row;
                        }

                        // Output data for each agency
                        foreach ($groupedProducts as $agencyName => $products) {
                    ?>
                            <div class="col-sm-4 col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header"><?php echo $agencyName; ?></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $count = 0;
                                            foreach ($products as $product) {
                                                if ($count % 2 == 0 && $count > 0) {
                                                    echo '</div><div class="row">';
                                                }
                                            ?>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <img src="image1/p1.jpeg" class="card-img-top image-fluid" alt="Product Image">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $product['p_name']; ?></h5>
                                                            <p class="card-text">Price: <?php echo $product['price']; ?></p>
                                                            <p class="card-text">Discount: <?php echo $product['discount']; ?></p>
                                                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>


            </div>
        </section>
        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <h2 class="display-4 fw-bold lh-1 text-body-emphasis text-primary">Here we have the top aggencies
                        with us.</h2>
                    <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the
                        world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
                        responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <a href="login.html"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" fdprocessedid="hgme3">Explore</button></a>

                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg border-2 border-dark">
                    <img class="rounded-lg-3 image-fluid" src="image1/pexels-lukas-669612.jpg" alt="" width="720">
                </div>
            </div>
        </div>

    </main>

    <?php include('footer.php') ?>

</body>

</html>
<?php 
// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle adding items to the cart
if(isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    // Add the product ID to the cart array in session
    $_SESSION['cart'][] = $productId;
    // Redirect to prevent form resubmission
    header("Location: index.php");
    exit;
}
?>