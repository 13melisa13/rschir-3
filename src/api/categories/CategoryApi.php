<?php

namespace api\categories;
require_once __DIR__.'/../Api.php';
require_once 'Category.php';
require_once __DIR__.'/../shops/Shop.php';
use api\Api;
use api\shops\Shop;

class CategoryApi extends Api{

    public $apiName = 'categories';
    /**
     *  Метод GET
     *  Вывод списка всех записей
     *  api/categories
     * @return string
     */
    protected function indexAction(): string{

        $categories = Category::getAll($this -> db);
        if($categories){
            return $this->response($categories, 200);
        }
        return $this->response('Categories not found', 404);
    }

    /**
     *  Метод GET
     *  Вывод записи по индексу
     *  api/categories/id
     * @return string
     */
    protected function viewAction(): string{
        $id = $this->requestParams['id'] ?? null;
        $category = Category::getByID($this->db, $id);
        if ($category)
            return $this->response($category, 200);
        return $this->response('Category with id='.$id.' not found', 404);
    }

    /**
     * Метод POST
     * Создание новой записи
     * api/categories ? name(require), description(require)
     * @return string
     */
    public function createAction(): string{
        $name = $this -> db ->real_escape_string($this->requestParams['name'] ?? '');
        $description = $this -> db ->real_escape_string($this->requestParams['description']?? '');
        $shop_id = Shop::getByID($this->db, $this->requestParams['shop_id'])['id'] ?? '';

        if($name && $description ){
            $category = new Category($name, $description, $shop_id);
            if($category -> saveNew($this -> db)){
                return $this->response($name .' saved.', 200);
            }
//            return $this->response($category->getName() .'not saved.');
        }
        return $this->response("Saving error");
    }

    /**
     * Метод PUT
     * Обновление записи по id
     * api/categories/id ? name(not require), description(not require)
     * @return string
     */
    protected function updateAction(): string{
        $id = $this->requestParams['id'] ?? null;
        $category = Category::getByID($this->db, $id);
        if (!$category)  return $this->response('Category with id='.$id.' not found', 404);
        $name = $this->requestParams['name'] ?? $category['name'];
        $description = $this->requestParams['description']?? $category['description'];
        $shop_id = Shop::getByID($this->db, $this->requestParams['shop_id'])['id'] ?? $category['shop_id'];

        if (Category:: update($this -> db, $id,$name, $description, $shop_id)){
                return $this->response("$name updated.", 200);
            }
        return $this->response("Updating error");
    }

    /**
     * Метод DELETE
     * Удаление записи по id CASCADE
     * api/categories/id
     * @return string
     */
    protected function deleteAction() : string{
        $id = $this->requestParams['id'] ?? null;
        if(!Category::getById($this -> db, $id)){
            return $this->response("Category with id=$id not found", 404);
        }
        if(Category::deleteById($this -> db, $id)){
            return $this->response('Category with id='.$id.' deleted.', 200);
        }
        return $this->response("Deleting error");
    }
}