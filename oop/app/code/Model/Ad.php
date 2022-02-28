<?php

namespace Model;

use Core\AbstractModel;
use Helper\DBHelper;

use Core\Interfaces\ModelInterface;


class Ad extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'ads';

    private $title;

    private $description;

    private $manufacturerId;

    private $modelId;

    private $price;

    private $year;

    private $typeId;

    private $userId;

    private $image;

    private $active;

    private $slug;

    private $vin;

    private $visitors;



    public function __construct($id = null)
    {
        if($id !== null){
            $this->load($id);
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

    }

    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;
    }
    public function getModelId()
    {
        return $this->modelId;
    }

    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getVin()
    {
        return $this->vin;
    }

    public function setVin($vin)
    {
        $this->vin = $vin;
    }

    public function getVisitors()
    {
        return $this->visitors;
    }

    public function setVisitors($visitors)
    {
        $this->visitors = $visitors;
    }


    public function assignData()
    {
        $this->data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' =>$this->typeId,
            'user_id' =>$this->userId,
            'image' => $this->image,
            'active' => $this->active,
            'slug' => $this->slug,
            'vin' => $this->vin,
            'visitors' => $this->visitors
        ];
    }

    public function load($id)
    {
        $db = new DBHelper();
        $ad = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if(!empty($ad))
        {
            $this->id = $ad['id'];
            $this->title = $ad['title'];
            $this->manufacturerId = $ad['manufacturer_id'];
            $this->description = $ad['description'];
            $this->modelId = $ad['model_id'];
            $this->price = $ad['price'];
            $this->year = $ad['year'];
            $this->typeId = $ad['type_id'];
            $this->userId = $ad['user_id'];
            $this->image = $ad['image'];
            $this->active = $ad['active'];
            $this->slug = $ad['slug'];
            $this->vin = $ad['vin'];
            $this->visitors = $ad['visitors'];
        }
        return $this;
    }

    public function loadBySlug($slug)
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('slug', $slug)->getOne();
        if(!empty($rez))
        {
            $this->load($rez['id']);
            return $this;
        }else{
            return false;
        }
    }

    public static function getAllAds($page = null, $limit = null)
    {
//        $results_per_page= 4;
//        if(isset($_GET['page']))
//        {
//            $page = $_GET['page'];
//        }else{
//            $page = 1;
//        }

        $db = new DBHelper();
        $db->select()->from(self::TABLE)->where('active', 1);
        if($limit != null)
        {
            $db->limit($limit);
        }
        if($page != null)
        {
            $db->offset($page);
        }
        $data = $db->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getNewest($limit)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->orderBy('id', 'DESC')->limit($limit)->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getPopular($limit)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active', 1)
            ->orderBy('visitors', 'DESC')
            ->limit($limit)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getAds($page = null, $limit = null)
    {
//
        $db = new DBHelper();
        $db->select()->from(self::TABLE);
        if($limit != null)
        {
            $db->limit($limit);
        }
        if($page != null)
        {
            $db->offset($page);
        }
        $data = $db->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public function getcomments()
    {

    }


}