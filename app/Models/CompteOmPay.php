<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Services\CompteOmPayService;

class CompteOmPay extends Model
{
    use HasFactory;

    protected $table = 'comptes_ompay';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'utilisateur_id',
        'compte_om_id',
        'devise',
        'actif',
    ];

    protected $appends = ['solde_virtual'];

    protected $casts = [
        'actif' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getSoldeVirtualAttribute()
    {
        return app(CompteOmPayService::class)->calculerSoldeVirtuel($this);
    }

    public function transactionsRecues()
    {
        return $this->hasMany(Transaction::class, 'compte_destination_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function compteOm()
    {
        return $this->belongsTo(CompteOm::class, 'compte_om_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'compte_source_id');
    }

    public function scopeValidee($query)
    {
        return $query->where('statut', 'validee');
    }

}
