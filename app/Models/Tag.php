<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $color
 */
class Tag extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'color',
    ];

    public function bugs(): BelongsToMany
    {
        return $this->belongsToMany(Bug::class, 'bug_tags', 'tag_id', 'bug_id')
            ->withPivot(['created_at']);
    }
}
