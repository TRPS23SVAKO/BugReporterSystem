<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $bug_id
 * @property int|null $actor_id
 * @property string $event_type
 * @property string|null $from_value
 * @property string|null $to_value
 * @property array|null $meta
 * @property Carbon|null $created_at
 */
class BugEvent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'bug_id',
        'actor_id',
        'event_type',
        'from_value',
        'to_value',
        'meta',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'meta' => 'array',
    ];

    public function bug(): BelongsTo
    {
        return $this->belongsTo(Bug::class, 'bug_id');
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
