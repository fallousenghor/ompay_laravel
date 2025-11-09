<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\TransactionService;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'compte_source_id',
        'compte_destination_id',
        'type_operation_id',
        'montant',
        'devise',
        'statut',
        'reference',
        'meta_donnees',
    ];

    protected $appends = ['frais', 'montant_total'];

    protected $casts = [
        'montant' => 'decimal:2',
        'meta_donnees' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
        });
    }

    public function compteSource()
    {
        return $this->belongsTo(CompteOmPay::class, 'compte_source_id');
    }

    public function compteDestination()
    {
        return $this->belongsTo(CompteOmPay::class, 'compte_destination_id');
    }

    public function typeOperation()
    {
        return $this->belongsTo(TypeOperation::class, 'type_operation_id');
    }

    public function marchand()
    {
        return $this->belongsTo(Marchand::class, 'meta_donnees->marchand_id'); // lecture via meta_donnees
    }

    public function getFraisAttribute()
    {
        return app(TransactionService::class)->calculerFrais($this);
    }

    public function getMontantTotalAttribute()
    {
        return app(TransactionService::class)->calculerMontantTotal($this);
    }
}
