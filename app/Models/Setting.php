<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $key
 * @property mixed $value
 * @property mixed $description
 */
class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
    ];
}
