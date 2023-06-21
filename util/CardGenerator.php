<?php

namespace util;

use Product;

class CardGenerator {
    public static function generateCards(array $database): string {
        $cards = '';

        foreach ($database as $product) {
            $cards .= self::generateCard($product);
        }

        return $cards;
    }

    private static function generateCard(Product $product): string {
        $type = $product->getType()->getName();
        $category = $product->getCategory()->getName();
        $price = $product->getPrice();
        $description = $product->getDescription();

        // Генерация HTML-кода карточки
        $card = '<div class="card">';
        $card .= '<h3>' . $type . '</h3>';
        $card .= '<p>Category: ' . $category . '</p>';
        $card .= '<p>Price: $' . $price . '</p>';
        $card .= '<p>Description: ' . $description . '</p>';
        $card .= '</div>';

        return $card;
    }
}
