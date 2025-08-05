<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'details',
        'web',
        'site_id',
    ];
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
