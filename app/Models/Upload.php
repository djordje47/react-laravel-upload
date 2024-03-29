<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'path',
    'description',
    'user_id',
    'emails'
  ];

  protected $casts = [
    'emails' => 'array'
  ];
}
