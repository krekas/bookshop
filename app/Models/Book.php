<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'user_id', 'approved'];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '1');
    }

    public function scopeUnapproved($query)
    {
        return $query->where('approved', 0);
    }

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'ASC');
    }
}
