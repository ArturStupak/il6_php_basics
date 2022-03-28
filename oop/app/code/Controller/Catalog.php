<?php

declare(strict_types=1);

namespace Controller;

use Core\AbstractController;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Url;
use Model\Comments;
use Model\Messages;
use Model\Ratings;
use Model\Remember;
use Model\User as UserModel;
use Model\Ad;
use Core\Interfaces\ControllerInterface;
use Service\PriceChangeInformer\Messenger;

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


    public function index(): void
    {
        $this->data['ad_count'] = Ad::count();
        $page = 0;
        if(isset($_GET['p'])){
            $page = (int)$_GET['p'] -1;
        }
        $this->data['ads'] = Ad::getAllAds($page * 2, 5);
        $this->render('catalog/list');

    }
    public function add(): void
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

    public function create(): void
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
        $ad->setPrice((int)$_POST['price']);
        $ad->setYear((int)$_POST['year']);
        $ad->setTypeId(1);
        $ad->setImage($_POST['image']);
        $ad->setActive(1);
        $ad->setSlug($slug);
        $ad->SetVin((int)$_POST['vin']);
        $ad->save();
        Url::redirect('catalog/all');

    }

    public function edit(int $id): void
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

    public function update(): void
    {
        $adId = $_POST['id'];
        $ad = new Ad();
        $ad->load((int)$adId);
        if($ad->getPrice() != $_POST['price'])
        {
            $messenger = new Messenger();
            $messenger->setMessages($adId);
        }
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice((float)$_POST['price']);
        $ad->setYear((int)$_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->save();

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


    public function show(string $slug): void
    {
        $ad = new Ad();
        $this->data['ad'] = $ad->loadBySlug($slug);
        if (!$ad) {
            $this->render('parts/errors/error404');
            return;
        }
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
            $this->data['rated'] = false;
            $rate = new Ratings();
            $isRateNull = $rate->loadByUserAndAd($_SESSION['user_id'], $ad->getId());
            if ($isRateNull !== null) {
                $this->data['rated'] = true;
                $this->data['user_rate'] = $rate->getRating();
            }

            $ratings = Ratings::getRatingsByAd($ad->getId());
            $sum = 0;
            foreach ($ratings as $rate) {
                $sum += $rate['rating'];
            }

            $this->data['ad_rating'] = 0;
            $this->data['rating_count'] = count($ratings);
            if ($sum > 0) {
                $this->data['ad_rating'] = $sum / $this->data['rating_count'];
            }
            $this->data['form'] = $form->getForm();
            $this->data['comments'] = Comments::getAdComments($ad->getId());
            $this->data['favorite'] = Remember::orAdIsFavorite($_SESSION['user_id'], $ad->getId());
            $this->render('catalog/single');
        }else{
            $this->render('parts/errors/error404');
        }
    }

//    public function createRating(): void
//    {
//        $rating = new Ratings();
//        $rating ->setUserId((int)$_SESSION['user_id']);
//        $rating ->setAdId((int)$_POST['id']);
//        $rating ->setRating((int)$_POST['rating']);
//        $rating ->save();
//        $rating  = new Ad();
//        $rating ->load((int)$_POST['id']);
//        Url::redirect('catalog/show/' .   $rating ->getSlug());
//    }
    public function rate()
    {
        $rate = new Ratings();
        $rate->loadByUserAndAd((int) $_SESSION['user_id'], (int) $_POST['ad_id']);
        $rate->setUserId((int)$_SESSION['user_id']);
        $rate->setAdId((int)$_POST['ad_id']);
        $rate->setRating((int)$_POST['rate']);
        $rate->save();
        $rating  = new Ad();
        $rating ->load((int)$_POST['ad_id']);
        Url::redirect('catalog/show/' .   $rating ->getSlug());

    }

    public function createcomment(): void
    {
        $comment = new Comments();
        $comment->setUserId($_SESSION['user_id']);
        $comment->setComment($_POST['comment']);
        $comment->setIp($_SERVER['REMOTE_ADDR']);
        $comment->setadId((int)$_POST['id']);
        $comment->save();
        $ad = new Ad();
        $ad->load((int)$_POST['id']);
        Url::redirect('catalog/show/' . $ad->getSlug());
    }

    public function createFavoriteAd()
    {
        $favorite = new Remember();
        $favorite->setUserId($_SESSION['user_id']);
        $favorite->setAdId((int)$_POST['ad_id']);
        $favorite->save();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/show/' . $ad->getSlug());
    }
    public function deleteFavoriteAd()
    {
        $favorite = new Remember();
        $favorite->loadFavoriteAd((int)$_SESSION['user_id'], (int)$_POST['ad_id']);
        $favorite->delete();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/show/' . $ad->getSlug());

    }
    public function deleteFavoriteAdFromList()
    {
        $favorite = new Remember();
        $favorite->loadFavoriteAd((int)$_SESSION['user_id'], (int)$_POST['ad_id']);
        $favorite->delete();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/showFavoriteAds/');
    }


    public function showFavoriteAds()
    {
        $this->data['favorites'] = Remember::getFavoriteAds($_SESSION['user_id']);
        $this->render('catalog/favorites');

    }

}