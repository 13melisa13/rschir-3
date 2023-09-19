<?php

namespace api\products;

use api\Api;
use api\categories\Category;
require_once 'Product.php';
require_once __DIR__.'/../Api.php';
require_once __DIR__.'/../categories/Category.php';
class ProductApi extends Api
{
    public $apiName = 'products';
    /**
     *  Метод GET
     *  Вывод списка всех записей
     *  api/products
     * @return string
     */
    protected function indexAction(): string
    {
        $products = Product::getAll($this -> db);
        if($products){
            return $this->response($products, 200);
        }
        return $this->response('Products not found', 404);
    }

    /**
     *  Метод GET
     *  Вывод записи по индексу
     *  api/products/id
     * @return string
     */
    protected function viewAction(): string
    {
        $id = $this->requestParams['id'] ?? null;
        $product = Product::getByID($this->db, $id);
        if ($product) {
            return $this->response($product, 200);
        }
        return $this->response('Product with id='.$id.' not found', 404);
    }

    /**
     * Метод POST
     * Создание новой записи
     * api/products + параметры запроса name, email
     * @return string
     */
    public function createAction(): string
    {
        $name = $this -> db ->real_escape_string($this->requestParams['name']) ?? '';
        $article = $this -> db ->real_escape_string($this->requestParams['article']) ?? '';
        $price = $this -> db ->real_escape_string($this->requestParams['price']) ?? '';
        $description = $this -> db ->real_escape_string($this->requestParams['description']) ?? '';
        $category_id = Category::getByID($this->db, $this -> db ->real_escape_string($this->requestParams['category_id'] ?? null))['id'];
        if($name && $price && $description && $category_id && $article){
            $product = new Product($name, $description, $price, $category_id, $article);
//
            if( $product->saveNew($this -> db)){
                return $this->response($name.' saved.', 200);
            }
        }
        return $this->response('Saving error');
    }

    /**
     * Метод PUT
     * Обновление записи по id
     * api/products/id ? name(not require), description(not require)
     * @return string
     */
    protected function updateAction(): string{
        $id = $this->requestParams['id'] ?? null;
        $product = Product::getByID($this->db, $id);
        $article = $this->requestParams['article'] ?? $product['article'];
        $name = $this->requestParams['name'] ?? $product['name'];
        $price = $this->requestParams['price'] ?? $product['price'];
        $description = $this->requestParams['description'] ?? $product['description'];
        $category_id = Category::getByID($this->db, $this->requestParams['category_id'])['id'] ?? $product['category_id'];
        if ($product && Product:: update($this -> db, $id,$name, $description, $category_id, $price, $article)) {

            return $this->response($name.' updated.', 200);
        }
        return $this->response("Updating error ");
    }

    /**
     * Метод DELETE
     * Удаление записи по id
     * api/products/id
     * @return string
     */
    protected function deleteAction() : string{
        $id = $this->requestParams['id'] ?? null;
        if(!Product::getById($this -> db, $id)){
            return $this->response("Product with id=$id not found", 404);
        }
        if(Product::deleteById($this -> db, $id)){
            return $this->response("Product with id=$id deleted", 200);
        }
        return $this->response("Deleting error");
    }
}