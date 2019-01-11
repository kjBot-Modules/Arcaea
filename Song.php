<?php
namespace kjBotModule\kj415j45\Arcaea;

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
        $data = \json_decode(\file_get_contents(__DIR__.'/Arcaea.Song.json'), true);
        if(isset($data[$id]))
        return new Song($data[$id][0], $data[$id][1], $data[$id][2]);
        else return NULL;
    }
}