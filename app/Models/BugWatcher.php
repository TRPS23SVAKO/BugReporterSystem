<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $bug_id
 * @property int $user_id
 * @property Carbon $created_at
 */
class BugWatcher extends Model
{
    protected $table = 'bug_watchers';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'bug_id',
        'user_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function bug(): BelongsTo
    {
        return $this->belongsTo(Bug::class, 'bug_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
