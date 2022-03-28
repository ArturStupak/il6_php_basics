<?php

namespace Controller;

use Core\AbstractController;
use Helper\CsvParser;
use Model\Ad;


class Export extends AbstractController{

    public function exec(){
        $ads = Ad::getAllAds();
        $file = fopen('../var/data.csv', 'a');
        $adsArray = [];
        foreach ($ads as $key => $ad){
            $adsArray[$key]['title'] = $ad->getTitle();
            $adsArray[$key]['description'] = $ad->getDescription();
            $adsArray[$key]['year'] = $ad->getYear();
            $adsArray[$key]['image'] = $ad->getImage();
            $adsArray[$key]['slug'] = $ad->getSlug();
            $adsArray[$key]['visitors'] = $ad->getVisitors();
        }
        $csv = PROJECT_ROOT_DIR. '/var/data.csv';
        CsvParser::createCSV($csv, $adsArray);
    }
}
