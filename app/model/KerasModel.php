<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class KerasModel extends Model
{
    //
    protected $table = 'UModel';
    protected $primaryKey = 'ModelID';
    protected $fillable = ['MName','ETrain','ETest' ,'optimizer','loss','metrics','batch_size','epochs','createby'  ];
    
}
