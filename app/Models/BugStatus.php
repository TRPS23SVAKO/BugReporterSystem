<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property string $label
 * @property int $sort_order
 * @property bool $is_active
 */
class BugStatus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key',
        'label',
        'sort_order',
        'color',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function bugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'status_id');
    }
}
