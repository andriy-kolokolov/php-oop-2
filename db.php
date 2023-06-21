<?php

use product\Type;

include_once "model/Product.php";
include_once "model/product/Type.php";
include_once "model/Category.php";

class db {

    static function getData(): array {
        return [
            new Product(new Type("Food"), new Category("Cats"), 20.00, "This is a cat food product description"),
            new Product(new Type("Toy"), new Category("Dogs"), 15.99, "This is a dog toy product description"),
            new Product(new Type("LitterBox"), new Category("Cats"), 50.00, "This is a cat litter box product description"),
            new Product(new Type("Collar"), new Category("Dogs"), 12.50, "This is a dog collar product description"),
            new Product(new Type("Toy Mouse"), new Category("Cats"), 7.99, "This is a toy mouse product description"),
            new Product(new Type("Food Bowl"), new Category("Dogs"), 10.00, "This is a food bowl product description"),
            new Product(new Type("Scratching Post"), new Category("Cats"), 35.00, "This is a cat scratching post product description"),
            new Product(new Type("Chew Toy"), new Category("Dogs"), 9.99, "This is a dog chew toy product description"),
        ];
    }

}