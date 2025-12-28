<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $attachable_type
 * @property mixed $attachable_id
 * @property string $file_path
 * @property string|null $original_name
 * @property string $file_type
 * @property int|null $size_bytes
 * @property string|null $checksum
 * @property int $uploaded_by
 * @property Carbon|null $created_at
 */
class Attachment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'attachable_type',
        'attachable_id',
        'file_path',
        'original_name',
        'file_type',
        'size_bytes',
        'checksum',
        'uploaded_by',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'size_bytes' => 'integer',
    ];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
