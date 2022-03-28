<?php

namespace Controller;

use Core\AbstractController;

use Helper\CsvParser;
use Helper\Url;
use Model\Ad;


class Import extends AbstractController
{
    public function execute()
    {
        $csvPath = PROJECT_ROOT_DIR . '/var/data.csv';
        $adsArray = CsvParser::parseCsv($csvPath);
        if ($adsArray !== FALSE) {
            foreach ($adsArray as $adData) {
                $ad = new Ad();
                $slug = Url::slug($adData['title']);
                while (!Ad::isValueUnic('slug', $slug)) {
                    $slug = $slug . rand(0, 100);
                }
                $ad->setTitle($adData['title']);
                $ad->setDescription($adData['description']);
                $ad->setYear($adData['years']);
                $ad->setManufacturerId(1);
                $ad->setModelId(1);
                $ad->setPrice($adData['price']);
                $ad->setImage($adData['image']);
                $ad->setActive(1);
                $ad->setVisitors(0);
                $ad->setSlug($slug);
                $ad->setTypeId(1);
                $ad->setUserId(10);
                $ad->save();
            }
            unlink($csvPath);
        } else {
            echo 'Nera tinkamo csv failo.';
        }
    }

}


function writeToCsv($data, $fileName){
    $file = fopen($fileName, 'a');
    foreach($data as $element){
        fputcsv ($file, $element);
    }
    fclose ($file);
}