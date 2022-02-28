<?php

namespace Controller;

use Core\AbstractController;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Url;
use Model\City;
use Model\Comments;
use Model\User as UserModel;
use Model\Ad;
use Core\Interfaces\ControllerInterface;

class Catalog extends AbstractController implements ControllerInterface
{
//    public function show($id = null)
//    {
//        if(id !== null){
//        echo 'Catalog controller ID ' . $id;
//        }
//    }
//
//    public function all()
//    {
//        for($i = 0; $i < 10; $i++){
//            echo '<a href="http://localhost/pamokos/oop/index.php/catalog/show/'.$i.'">Read more</a>';
//            echo '<br>';
//        }
//    }


    public function index()
    {
        $this->data['count'] = Ad::count();
        $page = 0;
        if(isset($_GET['p'])){
            $page = (int)$_GET['p'] -1;
        }
        $this->data['ads'] = Ad::getAllAds($page * 2, 2);
        $this->render('catalog/list');

    }
    public function add()
    {

        if (!isset($_SESSION['user_id'])) {

            Url::redirect('user/login');
        } else {
            $userId = $_SESSION['user_id'];
            $user = new UserModel();
            $user->load($userId);

            $db = new DBHelper();
            $form = new FormHelper('catalog/create', 'POST');


            $form->input([
                'name' => 'title',
                'type' => 'text',
                'placeholder' => 'title',


            ]);

            $form->input([
                'name' => 'id',
                'type' => 'hiden',

            ]);

            $form->textArea('description', 'description');


            $form->input([
                'name' => 'price',
                'type' => 'number',
                'placeholder' => 'Price',


            ]);
            $form->input([
                'name' => 'year',
                'type' => 'number',
                'placeholder' => 'year',


            ]);
            $form->input([
                'name' => 'image',
                'type' => 'text',
                'placeholder' => 'Paveiksliukas',

            ]);
            $form->input([
                'name' => 'vin',
                'type' => 'text',
                'placeholder' => 'Vin kodas',


            ]);

            $form->input([
                'class' => 'myButton',
                'name' => 'create',
                'type' => 'submit',
                'value' => 'submit'
            ]);
        }

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');
    }

    public function create()
    {
        $slug = URL::slug($_POST['title']);
        while(!Ad::isValueUnic('slug', $slug))
        {
            $slug = $slug.rand(0,100);
        }
        $ad = new Ad();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setImage($_POST['image']);
        $ad->setActive(1);
        $ad->setSlug($slug);
        $ad->SetVin($_POST['vin']);
        $ad->save();
        Url::redirect('catalog/all');

    }

    public function edit($id)
    {

        if (!isset($_SESSION['user_id'])) {

            Url::redirect('');
        }
        $ad = new Ad();
        $ad->load($id);

        if($_SESSION['user_id'] != $ad->getUserId())
        {
            Url::redirect('');
        }

        $form = new FormHelper('catalog/update', 'POST');
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

        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Paveiksliukas',
            'value' => $ad->getImage()


        ]);

        $form->input([
            'name' => 'status',
            'type' => 'number',
            'placeholder' => '1 or 0',
            'value' => $ad->isActive()

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
        $this->render('catalog/create');
    }

    public function update()
    {
        $adId = $_POST['id'];
        $ad = new Ad();
        $ad->load($adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->save();
    }


    public function show($slug)
    {
        $ad = new Ad();
        $this->data['ad'] = $ad->loadBySlug($slug);
        $this->data['title'] = $ad->getTitle();
        $this->data['meta_description'] = $ad->getDescription();
        if($this->data['ad']){
            $ad->setVisitors($ad->getVisitors() + 1);
            $ad->save();
            $form = new FormHelper('catalog/createcomment', 'POST');

            $form->textArea('comment', 'comment');

            $form->input([
                'type' => 'submit',
                'value' => 'sukurti',
                'name' => 'create'
            ]);
            $form->input([
                'name' => 'id',
                'type' => 'hidden',
                'value' => $ad->getId()
            ]);

            $this->data['form'] = $form->getForm();

            $this->data['comments'] = Comments::getAdComments($ad->getId());
            $this->render('catalog/single');
        }else{
            $this->render('parts/errors/error404');
        }


    }

    public function createcomment()
    {

        $comment = new Comments();
        $comment->setUserId($_SESSION['user_id']);
        $comment->setMessage($_POST['comment']);
        $comment->setIp($_SERVER['REMOTE_ADDR']);
        $comment->setadId($_POST['id']);
        $comment->save();
        $ad = new Ad();
        $ad->load($_POST['id']);
        Url::redirect('catalog/show/' . $ad->getSlug());

    }

}