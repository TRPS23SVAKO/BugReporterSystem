<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $type
 * @property string $key
 * @property string $label
 * @property int $sort_order
 * @property string|null $color
 * @property bool $is_active
 */
class BugLevel extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
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

    public function severityBugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'severity_id');
    }

    public function priorityBugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'priority_id');
    }
}
