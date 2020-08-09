<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DS extends Model
{
    //
    protected $table = 'UDS';
    protected $primaryKey = 'DSID';
    protected $fillable = [   
    'Name' ,
    'Description' ,
    'URL',
    'Privete',
    'createby'  
];
 
}
