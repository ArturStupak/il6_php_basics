<?php

declare(strict_types=1);
namespace Model;

use Helper\DBHelper;

class City
{
    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public static function getCities(): array
    {
        $db = new DBHelper();
        $data = $db->select()->from('cities')->get();
        $cities = [];
        foreach ($data as $element) {
            $city = new City();
            $city->load($element['id']);
            $cities[] = $city;
        }
        return $cities;
    }

    public function load(int $id) :City
    {
        $db = new DBHelper();
        $city = $db->select()->from('cities')->where('id',(string) $id)->getOne();
        $this->id = $city['id'];
        $this->name = $city['name'];
        return $this;

    }


//    private function create()
//    {
//        $data = [
//            'name' => $this->name,
//        ];
//
//        $db = new DBHelper();
//        $db->insert('cities', $data)->exec();
//    }
//
//    private function update() {
//
//    }
//
//    public function delete() {
//        $db = new DBHelper();
//        $db->delete()->from("cities")->where("id", $this->id)->exec();
//    }
//
//    public function load($id) {
//        $db = new DBHelper();
//        $data = $db->select()->from("cities")->where("id", $id)->getOne();
//
//        $this->id = $data['id'];
//        $this->name = $data['name'];
//    }
//
//    private static function formatList($data){
//        $formatted = [];
//        foreach ($data as $value) {
//            $formatted[$value["id"]] = $value["name"];
//        }
//
//        return $formatted;
//    }

//    public static function getList() {
//        $db = new DBHelper();
//        $cities = $db->select()->from("cities")->get();
//        return $cities;
//    }
}