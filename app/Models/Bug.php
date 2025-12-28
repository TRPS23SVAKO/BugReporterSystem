<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 * @property int $project_id
 * @property int $reporter_id
 * @property int|null $assigned_to
 * @property string $title
 * @property string $description
 * @property int $status_id
 * @property int $severity_id
 * @property int $priority_id
 * @property string|null $steps_to_reproduce
 * @property string|null $expected_result
 * @property string|null $actual_result
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Project $project
 * @property User $reporter
 * @property User $assignee
 * @property BugStatus $status
 * @property BugLevel $severity
 * @property BugLevel $priority
 * @property Collection<int, Comment> $comments
 * @property Collection<int, BugEvent> $events
 * @property Collection<int, Tag> $tags
 * @property Collection<int, User> $watchers
 * @property Collection<int, Attachment> $attachments
 */
class Bug extends Model
{
    protected $fillable = [
        'project_id',
        'reporter_id',
        'assigned_to',
        'title',
        'description',
        'status_id',
        'severity_id',
        'priority_id',
        'steps_to_reproduce',
        'expected_result',
        'actual_result',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(BugStatus::class, 'status_id');
    }

    public function severity(): BelongsTo
    {
        return $this->belongsTo(BugLevel::class, 'severity_id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(BugLevel::class, 'priority_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'bug_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(BugEvent::class, 'bug_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'bug_tags', 'bug_id', 'tag_id')
            ->withPivot(['created_at']);
    }

    public function watchers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bug_watchers', 'bug_id', 'user_id')
            ->withPivot(['created_at']);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
