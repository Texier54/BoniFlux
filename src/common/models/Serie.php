<?php

namespace geoquizz\common\models;

class Serie extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'serie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function photo(){
        return $this->hasMany('Photo');
    }

}
