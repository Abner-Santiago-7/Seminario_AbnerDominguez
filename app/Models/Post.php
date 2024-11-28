<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /*Especifca la tabla que yo quiero de la base de datos sin seguir el esquema de nombres del framework*/   
    protected $table='alumnos';


}
 