<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $primaryKey = "id";
    
    public $timestamps = true;

    //public const CREATED_AT = "creation_date";
    //public const UPDATED_AT = "last_update";
    protected $fillable = [ 'title', 'subtitle', 'description'];

    // Todos os campos que nao quero que seja alimentado automaticamente
    protected $guarded = [];
}
