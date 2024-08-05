<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use HasFactory;

	protected $fillable = [
		'message',
	];

	public function user(): BelongsTo 
	{
		return $this->belongsTo(User::class); 
	}

	public function blog(): BelongsTo 
	{
		return $this->belongsTo(Blog::class);
	}
}
