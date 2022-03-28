<?php

declare(strict_types=1);

namespace Controller;

use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Validator;
use Model\Comments;
use Model\User as UserModel;
use Model\City;
use Helper\Url;
use Core\AbstractController;
use Core\Interfaces\ControllerInterface;

class User extends AbstractController implements ControllerInterface
{

    public function index(): void
    {
        $this->data['ad'] = Ad::getAllAds();
        $this->render('catalog/list');
    }
    public function show(int $id): void
    {
        echo 'User controller ID: ' . $id;
    }

    public function register(): void
    {

        $db = new DBHelper();
        $form = new FormHelper('user/create', 'POST');

        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas'
        ]);
        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'placeholder' => 'Pavarde'
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+3706*******'
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);
        $form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => '* *** **2'
        ]);
        $cities = City::getCities();
        $options = [];
        foreach($cities as $city){
            $id = $city->getId();
            $options[$id] = $city->getName();
        }
        $form->select([
            "name" => "city_id",
            "options" => $options
        ]);
        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'register'
        ]);


        $this->data['form'] = $form->getForm();
        $this->render('user/register');
    }

    public function edit(): void
    {
        if(!isset($_SESSION['user_id'])) {

            Url::redirect('user/login');
        }else{
            $userId = $_SESSION['user_id'];
            $user = new UserModel();
            $user->load($userId);


            $form = new FormHelper('user/update', 'POST');
            $form->input([
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Vardas',
                'value' => $user->getName()
            ]);

            $form->input([
                'name' => 'last_name',
                'type' => 'text',
                'placeholder' => 'Pavarde',
                'value' => $user->getLastName()
            ]);
            $form->input([
                'name' => 'phone',
                'type' => 'text',
                'placeholder' => '+3706*******',
                'value' => $user->getPhone()
            ]);
            $form->input([
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'Email',
                'value' => $user->getEmail()
            ]);
            $form->input([
                'name' => 'password',
                'type' => 'password',
                'placeholder' => '* * * * * *'
            ]);
            $form->input([
                'name' => 'password2',
                'type' => 'password',
                'placeholder' => '* * * * * *'
            ]);

            $cities = City::getCities();
            $options = [];
            foreach ($cities as $city) {
                $id = $city->getId();
                $options[$id] = $city->getName();
            }
            $form->select([
                'name' => 'city_id',
                'options' => $options,
                'selected' => $user->getCityId()
            ]);
            $form->input([
                'name' => 'create',
                'type' => 'submit',
                'value' => 'register',
                'class' => 'myButton'
            ]);
        }

        $this->data['form'] = $form->getForm();
        $this->render('user/edit');
    }

    public function update(): void
    {

        $user = new UserModel();
        $user->load($_SESSION['user_id']);
        $user->setName($_POST['name']);
        $user->setLastName($_POST['last_name']);
        $user->setPhone($_POST['phone']);
        $user->setCityId($_POST['city_id']);


        if($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'] )) {
            $user->setPassword(md5($_POST['password']));
        }
        if($user->getEmail() != $_POST['email']){
            if(Validator::checkEmail($_POST['email']) && UserModel::isValueUnic('emai', $_POST['email'])){
                $user->setEmail($_POST['email']);
            }
        }
        $user->save();
        Url::redirect('user/edit');

    }
    public function login(): void
    {
        $form = new FormHelper('user/check', 'POST');
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);
        $form->input([
            'class' => 'myButton',
            'name' => 'login',
            'type' => 'submit',
            'value' => 'login'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('user/login');
    }


    public function create(): void
    {
        $passMatch = Validator::checkPassword($_POST['password'], $_POST['password2']);
        $isEmailValid = Validator::checkEmail($_POST['email']);
        $isEmailUnic = UserModel::isValueUnic('email', $_POST['email']);
        if($passMatch && $isEmailValid && $isEmailUnic){
            $user = new UserModel();
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
            $user->setPassword(md5($_POST['password']));
            $user->setEmail($_POST['email']);
            $user->setCityId((int)$_POST['city_id']);
            $user->setActive( 1);
            $user->setRoleId(0);
            $user->save();
            Url::redirect('user/login');
        }else{
            echo 'Patikrinkite duomenis';
        }
    }
        public function check(): void
        {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $userID = UserModel::checkLoginCredentionals($email, $password);
            if($userID)
            {
                $user = new UserModel();
                $user->load($userID);
                $_SESSION['logedin'] = true;
                $_SESSION['user_id'] = $userID;
                $_SESSION['user'] = $user;
                Url::redirect('/');

//                $user->getCity()->getName();
                print_r($user);
            }else{
                Url::redirect('user/login');
            }
        }

        public function logout(): void
        {
            session_destroy();
            Url::redirect('user/login');
        }




}