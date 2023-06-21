<?php

use product\Type;

include_once "model/Product.php";
include_once "model/product/Type.php";
include_once "model/Category.php";

class DataBase {

    static function getCardsData(): array {
        return [
            new Product("Cat Food", new Type("Food"), new Category("Cats"), 20.00, "This is a cat food product description"),
            new Product("Dog Toy", new Type("Toy"), new Category("Dogs"), 15.99, "This is a dog toy product description"),
            new Product("Cat Litter Box", new Type("LitterBox"), new Category("Cats"), 50.00, "This is a cat litter box product description"),
            new Product("Dog Collar", new Type("Collar"), new Category("Dogs"), 12.50, "This is a dog collar product description"),
            new Product("Toy Mouse", new Type("Toy Mouse"), new Category("Cats"), 7.99, "This is a toy mouse product description"),
            new Product("Dog Food Bowl", new Type("Food Bowl"), new Category("Dogs"), 10.00, "This is a food bowl product description"),
            new Product("Cat Scratching Post", new Type("Scratching Post"), new Category("Cats"), 35.00, "This is a cat scratching post product description"),
            new Product("Dog Chew Toy", new Type("Chew Toy"), new Category("Dogs"), 9.99, "This is a dog chew toy product description"),
        ];
    }

}