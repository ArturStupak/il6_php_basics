<?php

declare(strict_types=1);
namespace Model;

use Core\AbstractModel;
use Helper\DBHelper;

use Core\Interfaces\ModelInterface;


class Ad extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'ads';

    private string $title;

    private string $description;

    private int $manufacturerId;

    private int $modelId;

    private float $price;

    private int $year;

    private int $typeId;

    private int $userId;

    private string $image;

    private int $active;

    private string $slug;

    private int  $vin;

    private int $visitors;



    public function __construct(?int $id = null)
    {
        if($id !== null){
            $this->load($id);
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription() :string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;

    }

    public function getManufacturerId(): int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(int $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
    }
    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function setModelId(int $modelId): void
    {
        $this->modelId = $modelId;
    }


    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;

    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId($typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function isActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getVin(): int
    {
        return $this->vin;
    }

    public function setVin(int $vin): void
    {
        $this->vin = $vin;
    }

    public function getVisitors(): int
    {
        return $this->visitors;
    }

    public function setVisitors($visitors): void
    {
        $this->visitors = $visitors;
    }


    public function assignData(): void
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

    public function load(int $id): Ad
    {
        $db = new DBHelper();
        $ad = $db->select()->from(self::TABLE)->where('id',(string) $id)->getOne();
        if(!empty($ad))
        {
            $this->id = (int) $ad['id'];
            $this->title = $ad['title'];
            $this->manufacturerId = (int) $ad['manufacturer_id'];
            $this->description = $ad['description'];
            $this->modelId = (int)$ad['model_id'];
            $this->price =(int) $ad['price'];
            $this->year = (int)$ad['year'];
            $this->typeId =(int) $ad['type_id'];
            $this->userId =(int) $ad['user_id'];
            $this->image = $ad['image'];
            $this->active =(int) $ad['active'];
            $this->slug = $ad['slug'];
            $this->vin = (int)$ad['vin'];
            $this->visitors =(int) $ad['visitors'];
        }
        return $this;
    }

    public function loadBySlug(string $slug): ?Ad
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('slug', $slug)->getOne();
        if(!empty($rez))
        {
            $this->load((int)$rez['id']);
            return $this;
        }else{
            return null;
        }
    }

    public static function getAllAds(?int $page = null, ?int $limit = null): array
    {
        $db = new DBHelper();
        $db->select()->from(self::TABLE)->where('active', (string) 1);
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
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getNewest(int $limit): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->orderBy('id', 'DESC')->limit($limit)->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getPopular(int $limit): array
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active', (string)1)
            ->orderBy('visitors', 'DESC')
            ->limit($limit)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getAds(?int $page = null, ?int $limit = null): array
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
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }




}