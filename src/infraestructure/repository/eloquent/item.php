<?php

namespace Src\infraestructure\repository\eloquent;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $table = 'items';
    protected $fillable = ['nombre', 'precio'];
    
}