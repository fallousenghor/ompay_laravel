<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'users';

    protected $fillable = [
        'id',
        'telephone',
        'nom_complet',
        'email',
        'code_pin_hash',
        'statut_kyc',
        'statut_compte',
        'role',
    ];

    protected $hidden = [
        'code_pin_hash',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
        });
    }

    // Relations
    public function compteOmPay()
    {
        return $this->hasOne(CompteOmPay::class, 'utilisateur_id');
    }

    public function otpVerifications()
    {
        return $this->hasMany(OtpVerification::class, 'numero_telephone', 'telephone');
    }

}
