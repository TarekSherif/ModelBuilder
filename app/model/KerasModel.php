<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class KerasModel extends Model
{
    //
    protected $table = 'UModel';
    protected $primaryKey = 'ModelID';
    protected $fillable = ['MName','createby'  ];

 
    
}
