<?php
namespace Controller;

use Core\AbstractController;
use Model\Ad;

class Home extends AbstractController
{
    public function index()
    {
        $this->data['laters'] = Ad::getNewest(5);
        $this->data['populars'] = Ad::getPopular(5);
        $this->render('parts/home');

    }




}