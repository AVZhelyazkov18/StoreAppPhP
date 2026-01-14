<?php

class Client {
    private $name, $email, $balance, $id;

    public function __construct($id = 0, $name, $email, $balance) {
        $this->set_id($id);    
        $this->set_name($name);
        $this->set_email($email);
        $this->set_balance($balance);
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_balance($balance) {
        $this->balance = $balance;
    }

    public function get_balance() {
        return $this->balance;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
}

function list_clients(PDO $database) {
    $query = 'SELECT id, name, email, cash FROM users';
    $statement = $database->prepare($query);
    $statement->execute();
    $clients = $statement->fetchAll();
    $statement->closeCursor();

    $all_clients = array();

    foreach ($clients as $client) {
        $all_clients[] = new Client(
            $client['id'],
            $client['name'],
            $client['email'],
            $client['balance'],
        );
    }

    return $all_clients;
}

function insert_client($client) {
    global $database;

    $query = "insert into users (name, email, balance)
              values (:name, :email, :balance)";
    $statement = $database->prepare($query);
    $statement->bindValue(":name", $client->get_name());
    $statement->bindValue(":email", $client->get_email());
    $statement->bindValue(":balance", $client->get_balance());
    $statement->execute();
    $statement->closeCursor();
}

function update_client($client) {
    global $database;

    $query = "update users set name = :name, balance = :balance where email = :email";
    $statement = $database->prepare($query);
    $statement->bindValue(":name", $client->get_name());
    $statement->bindValue(":email", $client->get_email());
    $statement->bindValue(":balance", $client->get_balance());
    $statement->execute();
    $statement->closeCursor();
}

function delete_client($client) {
    global $database;

    $query = "delete from users
              where email = :email";
    $statement = $database->prepare($query);
    $statement->bindValue(":email", $client->get_email());
    $statement->execute();
    $statement->closeCursor();
}