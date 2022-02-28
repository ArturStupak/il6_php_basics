<?php
namespace Controller;

use Core\AbstractController;
use Model\Ad;
use Core\Interfaces\ControllerInterface;

class Home extends AbstractController implements ControllerInterface
{
    public function index()
    {
        $this->data['laters'] = Ad::getNewest(5);
        $this->data['populars'] = Ad::getPopular(5);
        $this->render('parts/home');

    }




}