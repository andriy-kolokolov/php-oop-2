<?php

use product\Type;

class Product {
    private string $name;
    private Type $type;
    private Category $category;
    private float $price;
    private string $description;


    public function __construct(string $name, Type $type, Category $category, float $price, string $description) {
        $this->name = $name;
        $this->type = $type;
        $this->category = $category;
        $this->price = $price;
        $this->description = $description;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): Type {
        return $this->type;
    }

    public function getCategory(): Category {
        return $this->category;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

}
