<?php
namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;


class Messages extends AbstractModel implements ModelInterface
{

    private $receiverId;

    private $message;

    private $senderId;

    private $date;


    private $status;

    protected const TABLE = 'messages';

    public function __construct($id = null)
    {
        if($id !== null){
            $this->load($id);
        }

    }

    public function assignData()
    {
        $this->data = [
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
            'date' => $this->date,
            'sender_id' => $this->senderId,
            'status' => $this->status
        ];
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }


    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }


    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        $this->receiverId = $data['receiver_id'];
        $this->message = $data['message'];
        $this->date = $data['date'];
        $this->senderId = $data['sender_id'];
        $this->status = $data['status'];
        return $this;
    }
    public static function getUsers()
    {
        $db = new DBHelper();
        $data = $db->select('DISTINCT sender_id')->from(self::TABLE)->get();
        return $data;
//        $users = [];
//        foreach($data as $element){
//            $user = new Messages();
//            $user->load($element)
//        }
    }

    public static function getUserMessages($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('receiver_id', $id)->get();
        $messages = [];
        foreach ($data as $element) {
            $message = new Messages();
            $message->load($element['id']);
            $messages[] = $message;
        }
        return $messages;
    }
    public static function getSenderMessage($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('sender_id', $id)->get();
        $messages = [];
        foreach ($data as $element) {
            $message = new Messages();
            $message->load($element['id']);
            $messages[] = $message;
        }
        return $messages;
    }

    public static function getCountMessages($id)
    {
        $db = new DBHelper();
        $data = $db->select('count(*)' )->from(self::TABLE)->where('receiver_id', $id)->getOne();
        return $data[0];
    }


}
