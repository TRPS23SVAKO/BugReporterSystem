<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $value
 * @property string $description
 */
class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    protected $casts = [
        'id' => 'int',
    ];
}
