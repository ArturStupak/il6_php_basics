<?php

namespace Controller;

use Core\AbstractController;

class Import extends AbstractController
{
    public function execute()
    {
        $data = [];
        $file = fopen($fileName, 'r');
        while (!feof($file)){
            $line = fgetcsv($file);
            if(!empty($line)){
                $data[] = $line;
            }
        }
        fclose($file);
        return $data;

    }



}