<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $bug_id
 * @property int $tag_id
 * @property Carbon $created_at
 */
class BugTag extends Model
{
    protected $table = 'bug_tags';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'bug_id',
        'tag_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function bug(): BelongsTo
    {
        return $this->belongsTo(Bug::class, 'bug_id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
