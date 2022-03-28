<?php

namespace Service\PriceChangeInformer;
use Model\Remember;
use Helper\DBHelper;

class Messenger
{
    public function setMessages($adId)
    {
        $userIds = Remember::getUsersIdsByAd($adId);
        foreach($userIds as $userId){
            $db = new DBHelper();
            $data = [
                'user_id' => $userId,
                'ad_id' => $adId
            ];
            $db->insert('price_informer_queue',$data)->exec();
        }
    }
}