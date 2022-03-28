<?php
declare(strict_types=1);
namespace Model;

use Core\AbstractModel;
use Helper\DBHelper;
use Core\Interfaces\ModelInterface;

class Comments extends AbstractModel implements ModelInterface
{

    private int $userId;

    private string $comment;

    private string $ip;

    private int $adId;

    protected const TABLE = 'comments';

    public function __construct(?int $id = null)
    {
        if($id !== null){
            $this->load($id);
        }

    }

    public function assignData(): void
    {
        $this->data = [
            'user_id' => $this->userId,
            'comment' => $this->comment,
            'ip' => $this->ip,
            'ad_id' => $this->adId
        ];
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    public function getAdId(): int
    {
        return $this->adId;
    }

    public function setAdId(int $adId): void
    {
        $this->adId = $adId;
    }


    public function load(int $id): object
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', (string) $id)->getOne();
        $this->id =(int) $data['id'];
        $this->userId =(int) $data['user_id'];
        $this->comment = $data['comment'];
        $this->ip = $data['ip'];
        $this->adId =(int) $data['ad_id'];
        return $this;
    }

    public static function getAdComments(int $id): array
    {

        $db = new DBHelper();
        $db->select()->from(self::TABLE)->where('ad_id', (string) $id);
        $data = $db->get();
        $comments = [];
        foreach ($data as $element) {
            $comment = new Comments();
            $comment->load((int)$element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }



//    public function addcomment()
//    {
//        $db = A
//    }



}




