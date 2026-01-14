<?php

class Order
{

    private $id, $client_id, $created_at;

    public function __construct($client_id, $created_at, $id = 0)
    {
        $this->client_id = $client_id;
        $this->created_at = $created_at;
        $this->id = $id;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_client_id()
    {
        return $this->client_id;
    }

    public function get_created_at()
    {
        return $this->created_at;
    }
}

function create_order(Order $order, array $order_items)
{
    global $database;

    try {
        $database->beginTransaction();

        $statement = $database->prepare(
            "INSERT INTO orders (client_id, created_at)
             VALUES (:client_id, :created_at)"
        );
        $statement->bindValue(":client_id", $order->get_client_id());
        $statement->bindValue(":created_at", $order->get_created_at());
        $statement->execute();

        $order_id = (int)$database->lastInsertId();

        
        foreach ($order_items as $item) {
            var_dump($order_id, $item->get_product_id(), $item->get_quantity());
            $statement = $database->prepare("INSERT INTO order_items (order_id, product_id, quantity)
                    VALUES (:order_id, :product_id, :quantity)");
            $statement->bindValue(":order_id", $order_id);
            $statement->bindValue(":product_id", $item->get_product_id());
            $statement->bindValue(":quantity", $item->get_quantity());
            $statement->execute();

            $statement = $database->prepare("UPDATE products SET quantity = quantity - :quantity WHERE id = :product_id");

            $statement->bindValue(":quantity", $item->get_quantity());
            $statement->bindValue(":product_id", $item->get_product_id());
            $statement->execute();
        }

        $database->commit();

        return $order_id;
    } catch (PDOException $e) {
        $database->rollBack();
        throw $e;
    }
}