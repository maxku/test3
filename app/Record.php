<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{

    protected $fillable = ['title', 'description', 'image'];

    protected $table = 'records';

    public $timestamps = false;
}
