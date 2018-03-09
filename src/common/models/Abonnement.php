<?php

namespace boniflux\common\models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Abonnement extends \Illuminate\Database\Eloquent\Model {

	use SoftDeletes;

    protected $table = 'abonnement';
    protected $primaryKey = 'id';
    public $timestamps = true;
    	
    protected $dates = ['deleted_at'];


}
