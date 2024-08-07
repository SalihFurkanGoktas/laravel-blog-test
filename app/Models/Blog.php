<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
	    'title',
	    'heading',
	    'content',
    ];

    public function user(): BelongsTo
    {
	    return $this->belongsTo(User::class);
    }

    public function comments(): HasMany 
    {
	    return $this->hasMany(Blog::class);
    }

    public function getRouteKeyName(): string {
	    return 'heading';
    }
}
