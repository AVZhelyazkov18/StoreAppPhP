<?php

class Product {

    private $id, $name, $price, $quantity, $unit_type;

    public function __construct($id = 0, $name, $price, $quantity , $unit_type) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->id = $id;
        $this->unit_type = $unit_type;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_price() {
        return $this->price;
    }

    public function get_quantity() {
        return $this->quantity;
    }

    public function get_unit_type() {
        return $this->unit_type;
    }
}

function list_products() {
    global $database;
    
    $statement = $database->prepare(
        "SELECT id, name, price, quantity, unit_type FROM products"
    );
    $statement->execute();
    $rows = $statement->fetchAll();
    $statement->closeCursor();

    $products = array();

    foreach ($rows as $row) {
        $products[] = new Product(
            $row['id'],
            $row['name'],
            $row['price'],
            $row['quantity'],
            $row['unit_type'],
        );
    }

    return $products;
}

function search_products($query) {
    global $database;

    $stmt = $database->prepare(
        'SELECT id, name, price, quantity, unit_type
         FROM products
         WHERE name LIKE :q'
    );

    $stmt->execute([
        'q' => '%'.$query.'%'
    ]);

    $rows = $stmt->fetchAll();

    $products = [];

    foreach ($rows as $row) {
        $products[] = new Product(
            $row['id'],
            $row['name'],
            $row['price'],
            $row['quantity'],
            $row['unit_type']
        );
    }

    return $products;
}
