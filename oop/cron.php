<?php

include 'vendor/autoload.php';
include 'Helper\Dbhelper';

$messenger = new \Service\PriceChangeInformer\Cron;

$messenger->exec();