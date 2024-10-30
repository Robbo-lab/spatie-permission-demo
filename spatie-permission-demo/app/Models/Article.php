<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    /**
     * Define a relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}