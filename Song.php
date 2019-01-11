<?php
namespace kjBotModule\kj415j45\Arcaea;

use kjBot\Framework\DataStorage;


class Song{
    public $artist;
    public $title;
    public $mapper;

    protected function __construct($artist, $title, $mapper){
        $this->artist = $artist;
        $this->title = $title;
        $this->mapper = $mapper;
    }

    public static function CreateFromId($id){
        $data = \json_decode(DataStorage::GetData('Arcaea.Song.json'), true);
        return new Song($data[$id][0], $data[$id][1], $data[$id][2]);
    }
}