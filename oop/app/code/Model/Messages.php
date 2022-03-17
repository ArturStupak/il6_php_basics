<?php

declare(strict_types=1);
namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;



class Messages extends AbstractModel implements ModelInterface
{

    private int $receiverId;

    private string $message;

    private int $senderId;

    private string $date;

    private int $status;

    protected const TABLE = 'messages';

    public function __construct(?int $id = null)
    {
        if($id !== null){
            $this->load($id);
        }

    }

    public function assignData(): void
    {
        $this->data = [
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
            'sender_id' => $this->senderId,
            'status' => (int)$this->status
        ];
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function setReceiverId(int $receiverId): void
    {
        $this->receiverId = $receiverId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function load(int $id): object
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', (string) $id)->getOne();
        if(!empty($data)){
            $this->id = $data['id'];
            $this->receiverId = $data['receiver_id'];
            $this->message = $data['message'];
            $this->date = $data['date'];
            $this->senderId = $data['sender_id'];
            $this->status = $data['status'];
        }
        return $this;
    }

    public static function getUserRelatedMessage(): array
    {
        $db = new DBHelper();
        $userId = $_SESSION['user_id'];
        $data = $db->select()
            ->from(self::TABLE)
            ->where('receiver_id', (string) $userId)
            ->orWhere('sender_id', (string) $userId)
            ->get();
        $messages = [];
        foreach ($data as $element) {
            $message = new Messages();
            $message->load($element['id']);
            $messages[] = $message;
        }
        return $messages;
    }
    public static function getUnreadMessagesCount(): int
    {
        $db = new DBHelper();
        $rez = $db->select('COUNT(*)')->from(self::TABLE)->where('receiver_id', $_SESSION['user_id'])->andWhere('status', (string)1)->get();
        return (int)$rez[0][0];
    }

    public static function getUserMessagesWithFriend($friendId)
    {
        $db = new DBHelper();
        $userId= $_SESSION['user_id'];
        $data = $db->select()->from(self::TABLE)->where('sender_id', (string)$userId)->andWhere('receiver_id', (string)$friendId)->orWhere('receiver_id',(string) $userId)->andWhere('sender_id',(string) $friendId)->get();
        $messages = [];
        foreach ($data as $element){
            $message = new Messages();
            $message->load($element['id']);
            $messages[] = $message;
        }
        return $messages;
    }
//    public static function getSenderMessage(int $id): array
//    {
//        $db = new DBHelper();
//        $data = $db->select()->from(self::TABLE)->where('sender_id', (string) $id)->get();
//        $messages = [];
//        foreach ($data as $element) {
//            $message = new Messages();
//            $message->load($element['id']);
//            $messages[] = $message;
//        }
//        return $messages;
//    }

    public static function getUnreadMessageCount(): int
    {
        $db = new DBHelper();
        $data = $db->select('count(*)' )
            ->from(self::TABLE)
            ->where('receiver_id', (string) $_SESSION['user_id'])
            ->andWhere('status', '1')
            ->getOne();
        return (int)$data[0];
    }

    public static function makeSeen($senderId, $receiverId)
    {
        $db = new DBHelper();
        $db->update(self::TABLE, ['status' => 0])->where('sender_id',(string) $senderId)->andWhere('receiver_id',(string) $receiverId)->andWhere('status', (string) 1)->exec();
    }



}
