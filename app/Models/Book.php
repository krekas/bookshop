<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Book extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['name', 'slug', 'cover', 'description', 'price', 'discount', 'user_id', 'approved'];

    protected $casts = ['discount' => 'integer'];

    protected $perPage = 10;

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAvgRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
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

    public function getDiscountPriceAttribute()
    {
        return number_format($this->price - ($this->price * ($this->discount / 100)), 2);
    }

    // Is Povilo review video
    public function getIsNewAttribute()
    {
        return now()->subDays(7) <= $this->created_at;
    }
}
