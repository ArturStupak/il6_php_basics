<?php

declare(strict_types=1);

namespace Model;
use Core\AbstractModel;
use Helper\DBHelper;
use Core\Interfaces\ModelInterface;

class Ratings extends AbstractModel implements ModelInterface
{

    private int $userId;

    private int $adId;

    private int $rating;

    protected const TABLE = 'ratings';


    public function __construct(?int $id = null)
    {
        if($id !== null){
            $this->load($id);
        }

    }



    public function getUserId(): int
    {
        return $this->userId;
    }


    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }


    public function getAdId(): int
    {
        return $this->adId;
    }


    public function setAdId(int $adId): void
    {
        $this->adId = $adId;
    }


    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function assignData(): void
    {
        $this->data = [
            'user_id' => $this->userId,
            'ad_id' => $this->adId,
            'rating' => $this->rating
        ];
    }

    public function load(int $id): ?object
    {
        $rating = new DBHelper();
        $data = $rating->select()->from(self::TABLE)->where('id', (string) $id)->getOne();
        if(!empty($data)){
            $this->id =(int) $data['id'];
            $this->userId =(int) $data['user_id'];
            $this->adId = (int)$data['ad_id'];
            $this->rating =(int) $data['rating'];
            return $this;
        }
        return null;
    }
    public function loadByUserAndAd(int $userId, int $adId): ?object
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('user_id', (string)$userId)->andWhere('ad_id', (string)$adId)->getOne();

        if (!empty($rez)) {
            $this->load((int)$rez['id']);
            return $this;
        }

        return null;
    }

    public function getUser()
    {
        $user = new User();
        $user->load($this->userId);
        return $user;
    }
    public function getAd()
    {
        $ad = new Ad();
        $ad->load($this->adId);
        return $ad;
    }



    public static function getRatingsByAd(int $adId):array
    {
        $db = new DBHelper();
        return $db->select()->from(self::TABLE)->where('ad_id', (string )$adId)->get();
    }

//    public static function checkIfUserVoted($userId, $adId)
//    {
//        $db = new DBHelper();
//        $data = $db->select()->from(self::TABLE)->where('user_id',(string) $userId)->andWhere('ad_id',(string) $adId)->getOne();
//        return isset($data['id']) ? $data['id'] : null;
//    }
//
//
//    public static function getRatingAverage($id)
//    {
//        $db = new DBHelper();
//        $data = $db->select('AVG(rating)')->from(self::TABLE)->where('ad_id',(string) $id)->getOne();
//        return $data;
//
//    }


}