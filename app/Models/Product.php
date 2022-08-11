<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_uuid',
        'uuid',
        'title',
        'price',
        'description',
        'metadata',
    ];

    /**
     * Scope a query to only include products of a given uuid.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $uuid
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }
}
