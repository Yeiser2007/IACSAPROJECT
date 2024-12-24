<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abilitations extends Model
{
 protected $table = 'abilitations';

 protected $fillable = [

  'name',
  'description',
  'status',
  'created_at',
  'updated_at',

 ];

}
