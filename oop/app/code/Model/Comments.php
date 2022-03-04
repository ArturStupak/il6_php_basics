<?php

namespace Model;

use Core\AbstractModel;
use Helper\DBHelper;
use Core\Interfaces\ModelInterface;

class Comments extends AbstractModel implements ModelInterface
{

    private $userId;

    private $message;

    private $ip;

    private $adId;

    protected const TABLE = 'comments';

    public function __construct($id = null)
    {
        if($id !== null){
            $this->load($id);
        }

    }

    public function assignData()
    {
        $this->data = [
            'user_id' => $this->userId,
            'message' => $this->message,
            'ip' => $this->ip,
            'ad_id' => $this->adId
        ];
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getAdId()
    {
        return $this->adId;
    }

    public function setAdId($adId)
    {
        $this->adId = $adId;
    }


    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        $this->id = $data['id'];
        $this->userId = $data['user_id'];
        $this->comment = $data['comment'];
        $this->ip = $data['ip'];
        $this->adId = $data['ad_id'];
        return $this;
    }

    public static function getAdComments($id)
    {

        $db = new DBHelper();
        $db->select()->from(self::TABLE)->where('ad_id', $id);
        $data = $db->get();
        $comments = [];
        foreach ($data as $element) {
            $comment = new Comments();
            $comment->load($element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }



//    public function addcomment()
//    {
//        $db = A
//    }



}




