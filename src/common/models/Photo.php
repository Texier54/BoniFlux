<?php

namespace geoquizz\common\models;

class Photo extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'photo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function serie(){
        return $this->belongsTo('Serie');
    }


}
