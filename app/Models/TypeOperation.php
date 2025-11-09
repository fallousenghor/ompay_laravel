<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class TypeOperation extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'type_operations';

    protected $fillable = [
        'id',
        'code',
        'description',
        'limite_min',
        'limite_max'
    ];

    protected $casts = [
        'limite_min' => 'decimal:2',
        'limite_max' => 'decimal:2'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
        });
    }

    public function frais()
    {
        return $this->hasMany(Frais::class, 'type_operation_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'type_operation_id');
    }
}
