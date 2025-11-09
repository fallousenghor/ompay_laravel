<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class CompteOm extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'comptes_om';

    protected $fillable = [
        'id',
        'numero_telephone',
        'identifiant_om',
        'solde_om',
        'devise',
        'actif',
    ];

    protected $casts = [
        'solde_om' => 'decimal:2',
        'actif' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
        });
    }

    public function comptesOmPay()
    {
        return $this->hasMany(CompteOmPay::class, 'compte_om_id');
    }
}
