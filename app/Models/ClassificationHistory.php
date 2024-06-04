<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassificationHistory extends Model
{
    use HasFactory;

    protected $table = 'classification_history';

    protected $fillable = [
        'user_id',
        'fish_name',
        'fish_type',
        'fish_description',
        'fish_food',
        'fish_food_stall',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
