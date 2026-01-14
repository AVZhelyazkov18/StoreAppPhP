<?php

class OrderItem {
    private $product_id,$quantity, $price_per_kg, $id;

    public function __construct($product_id, $quantity) { 
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public function get_product_id() {
        return $this->product_id;
    }

    public function get_quantity() {
        return $this->quantity;
    }
}

function list_order_items($order_id) {
    global $database;

    $statement = $database->prepare(
        "SELECT id, product_id, quantity
         FROM order_items
         WHERE order_id = :order_id"
    );

    $statement->execute([
        'order_id' => $order_id
    ]);

    $rows = $statement->fetchAll();
    $statement->closeCursor();

    $items = [];

    foreach ($rows as $row) {
        $items[] = new OrderItem(
            $row['product_id'],
            $row['quantity'],
        );
    }

    return $items;
}
