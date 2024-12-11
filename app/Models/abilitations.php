<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class abilitations extends Model
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
