<?php

namespace geoquizz\common\models;

class User extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    public $timestamps = false;


}