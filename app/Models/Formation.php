<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Formation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'duration',
        'price',
        'level',
        'max_participants',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'duration' => 'integer',
        'max_participants' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($formation) {
            if (empty($formation->slug)) {
                $formation->slug = Str::slug($formation->title);
            }
        });

        static::updating(function ($formation) {
            if ($formation->isDirty('title') && empty($formation->slug)) {
                $formation->slug = Str::slug($formation->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now())
            ->where('status', 'published');
    }
}
