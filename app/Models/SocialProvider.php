<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    use HasFactory;

    protected $fillable = ['provider_id', 'provider'];

    public const PROVIDERS = ['facebook', 'google', 'github'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
