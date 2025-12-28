<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property int $role_id
 * @property bool $is_active
 * @property string $password
 * @property Role|null $role
 * @property Collection<int, Project> $ownedProjects
 * @property Collection<int, Project> $projects
 * @property Collection<int, Bug> $reportedBugs
 * @property Collection<int, Bug> $assignedBugs
 * @property Collection<int, Comment> $comments
 * @property Collection<int, Attachment> $uploadedAttachments
 * @property Collection<int, BugEvent> $bugEvents
 * @property Collection<int, ApiToken> $apiTokens
 * @property Collection<int, Bug> $watchedBugs
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function ownedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_members', 'user_id', 'project_id')
            ->withPivot(['project_role', 'joined_at']);
    }

    public function reportedBugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'reporter_id');
    }

    public function assignedBugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function uploadedAttachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'uploaded_by');
    }

    public function bugEvents(): HasMany
    {
        return $this->hasMany(BugEvent::class, 'actor_id');
    }

    public function apiTokens(): HasMany
    {
        return $this->hasMany(ApiToken::class, 'user_id');
    }

    public function watchedBugs(): BelongsToMany
    {
        return $this->belongsToMany(Bug::class, 'bug_watchers', 'user_id', 'bug_id');
    }
}
