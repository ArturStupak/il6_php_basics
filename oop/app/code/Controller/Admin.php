<?php

declare(strict_types=1);

namespace Controller;

use Core\AbstractController;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Validator;
use Model\Ad;
use Model\City;
use Model\User;
use Helper\Url;
use Model\User as UserModel;
use Core\Interfaces\ControllerInterface;


class Admin extends AbstractController implements ControllerInterface
{
    public const ACTIVE = 1;

    public const NOT_ACTIVE = 0;

    public const DELETE = 2;

    public function __construct()
    {
        parent::__construct();
        if(!$this->isUserAdmin()){
            Url::redirect('');
                //ne admin
        }
    }

    public function index()
    {
        $this->renderAdmin('index');
    }

    public function users()
    {
        $this->data['users'] = User::getAllUsers();
        $this->renderAdmin('users/list');
    }

    public function userEdit(int $id): void
    {
        $user = new UserModel();
        $user->load($id);

        $form = new FormHelper('admin/userupdate', 'POST');

        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas',
            'value' => $user->getName()
        ]);
        $form->input([
            'name' => 'user_id',
            'type'=> 'hidden',
            'value' => $id
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
        $form->select([
            'name' => 'active',
            'options' => [0 => 'not active', 1 => 'active'],
            'selected' => $user->isActive()
        ]);

        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'update',
            'class' => 'myButton'
        ]);


        $this->data['form'] = $form->getForm();
        $this->renderAdmin('/users/edit');

    }

    public function ads()
    {
        $this->data['ads'] = Ad::getAds();
        $this->renderAdmin('ads/list');
    }

    public function userupdate(): void
    {
        $userId = $_POST['user_id'];
        $user = new UserModel();
        $user->load((int)$userId);
        $user->setName($_POST['name']);
        $user->setLastName($_POST['last_name']);
        $user->setPhone($_POST['phone']);
        $user->setCityId((int)$_POST['city_id']);
        $user->setActive((int)$_POST['active']);



        if($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'] )) {
            $user->setPassword(md5($_POST['password']));
        }
        if($user->getEmail() != $_POST['email']){
            if(Validator::checkEmail($_POST['email']) && UserModel::isValueUnic('emai', $_POST['email'], 'users')){
                $user->setEmail($_POST['email']);
            }
        }
        $user->save();
        Url::redirect('admin/users');

    }

    public function adedit(int $id): void
    {
        $ad = new Ad($id);
        $form = new FormHelper('admin/adupdate', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas',
            'value' => $ad->getTitle()

        ]);

        $form->input([
            'name' => 'id',
            'type' => 'hiden',
            'value' => $ad->getId()


        ]);

        $form->textArea('description', $ad->getDescription());
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina',
            'value' => $ad->getPrice()

        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai',
            'value' => $ad->getYear()

        ]);

        $form->select([
            'name' => 'active',
            'options' => [0 => 'not active', 1 => 'active'],
            'selected' => $ad->isActive()

        ]);

        $form->input([
            'name' => 'status',
            'type' => 'number',
            'placeholder' => '1 or 0',
            'value' => $ad->getVin()

        ]);


        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->renderAdmin('ads/edit');
    }

    public function adupdate(): void
    {
        $adId = $_POST['id'];
        $ad = new Ad($adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->setActive($_POST['active']);
        $ad->save();
        Url::redirect('admin/ads');
    }



    public function massadupdate(): void
    {

        $action = $_POST['active'];
        $ids = $_POST['ad_id'];
        if ($action == self::ACTIVE || $action == self::NOT_ACTIVE) {
            foreach ($ids as $id) {
                $ad = new Ad($id);
                $ad->setActive($action);
                $ad->save();
            }
        } elseif ($action == self::DELETE) {
            foreach ($ids as $id) {
                $ad = new Ad($id);
                $ad->delete();
            }
        }
        Url::redirect('admin/ads');
    }


//
//        $adsIds = $_POST['ad_id'];
//        foreach ($adsIds as $id){
//           $user = new Ad();
//           $user->load($id);
//           $user->setActive($_POST['active']);
//           $user->save();
//        }
//        Url::redirect('admin/ads');
//    }
}