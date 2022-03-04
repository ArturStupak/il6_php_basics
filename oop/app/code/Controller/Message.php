<?php

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

    public function index()
    {

        $this->data['message'] = Messages::getUserMessages($_SESSION['user_id']);
        $this->data['sendermessage'] = Messages::getSenderMessage($_SESSION['user_id']);

        $this->render('message/all');

    }

    public function message()
    {

        if (!isset($_SESSION['user_id'])) {

            Url::redirect('user/login');
        } else {
            $userId = $_SESSION['user_id'];
            $user = new UserModel();
            $user->load($userId);

            $users = UserModel::getAllUsers();
            $options = [];
            foreach ($users as $user) {
                $id = $user->getId();
                $options[$id] = $user->getName();
            }

            $this->data['options'] = $options;
            $this->render('message/chat');
        }


    }

    public function chat()
    {

        if (!isset($_SESSION['user_id'])) {

            Url::redirect('user/login');
        } else {
            $userId = $_SESSION['user_id'];
            $user = new UserModel();
            $user->load($userId);

            $users = UserModel::getAllUsers();
            $options = [];
            foreach ($users as $user) {
                $id = $user->getId();
                $options[$id] = $user->getName();
            }

            $this->data['options'] = $options;
            $this->render('message/all');
        }


    }

//
    public function createMessage()
    {

        $ad = new Messages();
        $ad->setReceiverId($_POST['user_id']);
        $ad->setMessage($_POST['message']);
        $ad->setSenderId($_SESSION['user_id']);
        $ad->setStatus(1);
        $ad->save();
        Url::redirect('message/');

    }

    public function test()
    {
       $test = Messages::getUsers();
       echo "<pre>";
       print_r($test);
    }


}