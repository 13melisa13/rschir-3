<?php

namespace api\shops;
require_once __DIR__.'/../Api.php';
require_once 'Shop.php';
use api\Api;

class ShopApi extends Api{

    public $apiName = 'shops';
    /**
     *  Метод GET
     *  Вывод списка всех записей
     *  api/shops
     * @return string
     */
    protected function indexAction(): string{

        $shops = Shop::getAll($this -> db);
        if($shops){
            return $this->response($shops, 200);
        }
        return $this->response('Shops not found', 404);
    }

    /**
     *  Метод GET
     *  Вывод записи по индексу
     *  api/shops/id
     * @return string
     */
    protected function viewAction(): string{
        $id = $this->requestParams['id'] ?? null;
        $shop = Shop::getByID($this->db, $id);
        if ($shop)
            return $this->response($shop, 200);
        return $this->response('Shop with id='.$id.' not found', 404);
    }

    /**
     * Метод POST
     * Создание новой записи
     * api/shops ? name(require)
     * @return string
     */
    public function createAction(): string{
        $name = $this -> db ->real_escape_string($this->requestParams['name'] ?? '');
        if($name ){
            $shop = new Shop($name);
            if($shop -> saveNew($this -> db)){
                return $this->response($name .' saved.', 200);
            }
        }
        return $this->response("Saving error");
    }

    /**
     * Метод PUT
     * Обновление записи по id
     * api/shops/id ? name(not require)
     * @return string
     */
    protected function updateAction(): string{
        $id = $this->requestParams['id'] ?? null;
        $shop = Shop::getByID($this->db, $id);
        if (!$shop)  return $this->response('Shop with id='.$id.' not found', 404);
        $name = $this->requestParams['name'] ?? $shop['name'];

        if (Shop:: update($this -> db, $id,$name)){
                return $this->response("$name updated.", 200);
            }
        return $this->response("Updating error");
    }

    /**
     * Метод DELETE
     * Удаление записи по id CASCADE
     * api/shops/id
     * @return string
     */
    protected function deleteAction() : string{
        $id = $this->requestParams['id'] ?? null;
        if(!Shop::getById($this -> db, $id)){
            return $this->response("Shop with id=$id not found", 404);
        }
        if(Shop::deleteById($this -> db, $id)){
            return $this->response('Shop with id='.$id.' deleted.', 200);
        }
        return $this->response("Deleting error");
    }
}