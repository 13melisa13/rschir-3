<?php

namespace api\products;
use mysqli;

class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $category_id;


    public function getCategoryId()
    {
        return $this->category_id;
    }
    private $article;
    private $created;
    private $modified;
    public function __construct($name, $description, $price, $category_id, $article)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->article = $article;
    }

    public static function getAll( $db): array
    {

        $result = $db->query("SELECT * FROM products");
        while($row = mysqli_fetch_assoc($result))
            $test[] = $row;
        return $test;
    }


    public static function getByID($db, $id)
    {

        $result = $db->query("SELECT * FROM products where id = '$id'");
        while($row = mysqli_fetch_assoc($result))
            $test[] = $row;
        return $test[0];
    }

    public static function deleteById($db, $id):bool{

        return $db->query("delete from products where id = '$id'");
    }

    public function saveNew(?mysqli $db): bool{

        return $db->query("INSERT IGNORE INTO products (name, description, price, category_id, article)
            VALUES ('$this->name', '$this->description', '$this->price', '$this->category_id', '$this->article')");
    }


    public static function update( $db, $id, $name, $description, $category_id, $price, $article){

        return $db->query("UPDATE products set name = '$name', description = '$description', 
                 price = '$price', category_id = '$category_id', article='$article'  where id = '$id'");
    }


}