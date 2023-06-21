<?php

namespace util;

use Product;

class CardGenerator {
    public static function generateCardsGrid(array $cardsData, int $gridCols, int $gap): string {
        $cards = '';
        foreach ($cardsData as $product) {
            $cards .= self::generateCard($product);
        }
        return self::generateGrid($cards, $gridCols, $gap);
    }

    private static function generateCard(Product $product): string {
        $name = $product->getName();
        $type = $product->getType()->getName();
        $category = $product->getCategory()->getName();
        $price = $product->getPrice();
        $description = $product->getDescription();
        $imageSrc = "https://picsum.photos/200";

        return '
            <div class="col">
                <div class="card h-100">
                    <img src="' . $imageSrc . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Name: ' . $name . '</h5>
                        <p class="card-text">Description: ' . $description . '</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Category: ' . $category . '</li>
                        <li class="list-group-item">Type: ' . $type . '</li>
                        <li class="list-group-item">Price: ' . $price . ' $</li>
                    </ul>
                    <div class="card-body d-flex justify-content-around">
                        <a href="#" class="card-link">Add to cart <i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="#" class="card-link">Info</a>
                    </div>
                </div>
            </div>';
    }

    private static function generateGrid(string $cards, int $gridCols, int $gap): string {
        return '<div class="row row-cols-' . $gridCols . ' g-' . $gap . '">' . $cards . '</div>';
    }


}

