<?php

namespace Service\PriceChangeInformer;

use Helper\DBHelper;
use Model\User;
Use Model\Ad;
use Model\Messages;


class Cron
{
    public function exec()
    {
        $db = new DBHelper;
        $data = $db->select()->from('price_informer_queue')->limit(100)->get();
        foreach($data as $element){
            $user = new User();
            $user->load($element['user_id']);
            $ad = new Ad($element['ad_id']);
            $messageText = "Sveiki" . $user->getName() . " Automobilis" .  $ad->getTitle(). " pakeite kaina, gal jums butu idomu suzinoti";
            $message = new Messages();
            $message->setMessage($messageText);
            $message->setReceiverId($user->getId());
            $message->setSenderId(1);
            $message->setStatus(1);
            $message->save();
            $db = new DBHelper();
            $db->delete()->from('price_informer_queue')->where('id', $element['id'])->exec();
        }
    }
}