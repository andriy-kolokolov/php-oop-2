<?php
// import

use dao\ProductDAO;
use util\CardGenerator;

require 'dao/ProductDAO.php';
require 'util/CardGenerator.php';
require 'util/DatabaseUtil.php';
require 'ProductsArrayData.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Animal Products E-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

    <div class="container">
        <h1>Animal Products</h1>
        <?php
            // create connection and DAO object
            $dbUtil = new DatabaseUtil("localhost:8889", "root", "root", "animals_shop");
            $dbUtil->connect();
            $productDAO = new ProductDAO($dbUtil);
            // drop if exists and recreate table FOR TESTING
            $productDAO->dropProductsTable();
            $productDAO->createProductsTable();
            // get product objects from array
            $products = ProductsArrayData::getCardsData();
            //insert product objects in database
            foreach ($products as $product) {
                $productDAO->createProduct(
                        $product->getName(), 
                        $product->getType()->getName(),
                        $product->getCategory()->getName(),
                        $product->getPrice(),
                        $product->getDescription());
            }
            // get products from database
            $cardsData = $productDAO->getAllProducts();
            // generate grid using product object data
            $cards = CardGenerator::generateCardsGrid($cardsData, 4, 4);
            echo $cards;
            $dbUtil->close();
        ?>
    </div>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

</body>
</html>
