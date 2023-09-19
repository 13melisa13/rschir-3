<?php

namespace api\categories;


class Category{


    private  $id;

    private  $name;
    private $shop_id;


    public function getShopId()
    {
        return $this->shop_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    private  $description;

    private $created;

    public function getCreated()
    {
        return $this->created;
    }

    private $modified;


    public function __construct( $name, $description, $shop_id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->shop_id = $shop_id;


    }

    public static function getAll($db): array
    {

        $result = $db->query("SELECT * FROM categories");
        while($row = mysqli_fetch_assoc($result))
            $test[] = $row;
        return $test;
    }


    public static function getByID( $db, $id)
    {

        $result = $db->query("SELECT * FROM categories where id = '$id'");
        while($row = mysqli_fetch_assoc($result))
            $test[] = $row;
        return $test[0];
    }


    public static function deleteById( $db, $id):bool{

        return $db->query("delete from categories where id = '$id'");
    }


    public function saveNew($db): bool{

        return $db->query("INSERT IGNORE INTO categories (name, description, shop_id)
            VALUES ('$this->name', '$this->description', '$this->shop_id')");
    }



    public static function update( $db,  $id, $name, $description, $shop_id){

        return $db->query("UPDATE categories set name = '$name', description = '$description', shop_id=$shop_id where id = '$id'");
    }


}