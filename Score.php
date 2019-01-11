<?php
namespace kjBotModule\kj415j45\Arcaea;

class Score{
    public $performance;
    public $hp;
    public $countMiss;
    public $countNear;
    public $countPerfect;
    public $countShinyPerfect;
    public $clearType;
    public $bestClearType;
    public $mod;
    public $diff;
    public $song;
    public $score;

    public function __construct($obj){
        $this->performance = number_format($obj->rating, 2);
        $this->mod = $obj->modifier;
        $this->time = \DateTime::createFromFormat('U', intval($obj->time_played*0.001))->format('Y-m-d H:i:s');
        $this->hp = $obj->health;
        $this->bestClearType = $obj->best_clear_type;
        $this->clearType = $obj->clear_type;
        $this->countMiss = $obj->miss_count;
        $this->countNear = $obj->near_count;
        $this->countPerfect = $obj->perfect_count;
        $this->countShinyPerfect = $obj->shiny_perfect_count;
        $this->score = number_format($obj->score);
        $this->diff = Diff::ToText($obj->difficulty);
        $this->song = Song::CreateFromId($obj->song_id)??$obj->song_id;
    }

    public function toText(){
        $songInfo = isset($this->song->artist)?"{$this->song->artist} - {$this->song->title}[{$this->diff}] ({$this->song->mapper})":$this->song;
        return <<<EOT
{$songInfo}
{$this->time}

{$this->score}[{$this->hp}/100] {$this->clearType}({$this->bestClearType})
Rating: {$this->performance}
Pure: {$this->countPerfect}({$this->countShinyPerfect})
Far: {$this->countNear}
Miss: {$this->countMiss}

Mod: {$this->mod}
EOT;
    }
}