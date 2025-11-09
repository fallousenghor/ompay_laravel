<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Frais extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'frais';

    protected $fillable = [
        'id',
        'type_operation_id',
        'frais_fixe',
        'pourcentage_frais',
        'devise',
    ];

    protected $casts = [
        'frais_fixe' => 'decimal:2',
        'pourcentage_frais' => 'decimal:4', // pourcentage en fraction (ex: 0.015 = 1.5%)
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
        });
    }

    public function typeOperation()
    {
        return $this->belongsTo(TypeOperation::class, 'type_operation_id');
    }
}
