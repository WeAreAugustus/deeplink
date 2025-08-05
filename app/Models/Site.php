<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'android_link',
        'ios_link',
        'web_link',
        'api_key',
        'is_active',
    ];
    public function shortLinks()
    {
        return $this->hasMany(ShortLink::class);
    }
}
