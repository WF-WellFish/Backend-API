<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ClassificationHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classification_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'description',
        'food',
        'food_shop',
        'picture',
        'created_at',
        'updated_at',
    ];

    /**
     * Define the relationship with the user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the picture URL attribute.
     *
     * @return Attribute
     */
    public function pictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->picture ? Storage::disk('gcs-public')->url('/classification-histories/' . $this->picture) : null,
        );
    }
}
