<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $owner_id
 * @property bool $is_archived
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'is_archived',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id')
            ->withPivot(['joined_at']);
    }

    public function bugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'project_id');
    }
}
