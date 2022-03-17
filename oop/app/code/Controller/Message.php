<?php
declare(strict_types=1);
namespace Controller;


use Core\AbstractController;

use Core\Interfaces\ControllerInterface;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Url;
use Model\Ad;
use Model\City;
use Model\Comments;
use Model\Messages;

use Model\User as UserModel;


class Message extends AbstractController implements ControllerInterface
{

    public function __construct()
    {
        parent::__construct();
        if(!$this->isUserLoged())
        {
            Url::redirect('user/login');
        }
    }


    public function index(): void
    {
        $messages = Messages::getUserRelatedMessage();
        $chats = [];
        foreach ($messages as $message) {
            if($message->getSenderId() > $message->getReceiverId())
            {
                $key = $message->getReceiverId(). '-' . $message->getSenderId();
            }else{
                $key = $message->getSenderId(). '-' . $message->getReceiverId();
            }
            $chatFriendId = $message->getSenderId() == $_SESSION['user_id'] ? $message->getReceiverId() : $message->getSenderId();
            $chatFriend = new UserModel();
            $chatFriend->load($chatFriendId);
            $chats[$key]['message'] = $message;
            $chats[$key]['chat_friend'] = $chatFriend;
         }

        usort($chats, function ($item1, $item2) {
            return $item2['message']->getId() <=> $item1['message']->getId();
        });
        $this->data['chat'] = $chats;
        $this->render('message/all');

    }

    public function chat($chatFriendId)
    {
        $this->data['messages'] = Messages::getUserMessagesWithFriend($chatFriendId);
        Messages::makeSeen($chatFriendId, $_SESSION['user_id']);
        $this->data['receiver_id'] = $chatFriendId;
        $this->render('message/chat');
    }

    public function send()
    {
        $message = new Messages();
        $message->setMessage($_POST['message']);
        $message->setReceiverId((int)$_POST['receiver_id']);
        $message->setSenderId($_SESSION['user_id']);
        $message->setStatus(1);
        $message->save();
        Url::redirect('message/chat/' . $_POST['receiver_id']);
    }

    public function createMessage(): void
    {

        $ad = new Messages();
        $ad->setReceiverId((int)$_POST['user_id']);
        $ad->setMessage($_POST['message']);
        $ad->setSenderId($_SESSION['user_id']);
        $ad->setStatus(1);
        $ad->save();
        Url::redirect('message/');

    }

//    public function test(): void
//    {
//       $users = Messages::getUsers();
////       echo "<pre>";
////       print_r($test);
//        $options = [];
//        foreach ($users as $user) {
//            $id = $user->getId();
//            $options[$id] = $user->getName();
//        }
//
//        $this->data['options'] = $options;
//        $this->render('message/all');
//
//    }


}