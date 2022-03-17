<?php


declare(strict_types=1);

namespace Model;

use Core\AbstractModel;
use Helper\DBHelper;
use Core\Interfaces\ModelInterface;

class Remember extends AbstractModel implements ModelInterface
{

    private int $userId;

    private int $adId;

    protected const TABLE = 'favorites';


    public function __construct(?int $id = null)
    {
        if ($id !== null) {
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


    public function assignData(): void
    {
        $this->data = [
            'user_id' => $this->userId,
            'ad_id' => $this->adId,
        ];
    }

    public function load(int $id): ?object
    {
        $rating = new DBHelper();
        $data = $rating->select()->from(self::TABLE)->where('id', (string)$id)->getOne();
        if (!empty($data)) {
            $this->id = $data['id'];
            $this->userId = $data['user_id'];
            $this->adId = $data['ad_id'];
            return $this;
        }
        return null;
    }

    public static function orAdIsFavorite($userId, $adId): bool
    {
        $ad = new DBHelper();
        $data = $ad->select()->from(self::TABLE)->where('user_id', (string)$userId)->andWhere('ad_id', (string)$adId)->getOne();
        if (empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteFavoriteAd($userId, $adId)
    {
        $ad = new DBHelper();
        $ad->delete()->from(self::TABLE)->where('user_id', (string)$userId)->andWhere('ad_id', (string)$adId);
    }

    public function loadFavoriteAd(int $userId, int $adId)
    {
        $rating = new DBHelper();
        $data = $rating->select()->from(self::TABLE)->where('user_id', (string)$userId)->andWhere('ad_id', (string)$adId)->getOne();
        if (!empty($data)) {
            $this->id = $data['id'];
            $this->userId = $data['user_id'];
            $this->adId = $data['ad_id'];
            return $this;
        }
        return null;
    }

    public static function getFavoriteAds($userId)
    {
        $db = new DBHelper();
        $db->select()->from(self::TABLE)->where('user_id', (string)$userId);
        $data = $db->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['ad_id']);
            $ads[] = $ad;
        }
        return $ads;
    }




}