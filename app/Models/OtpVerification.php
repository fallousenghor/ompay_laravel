<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpVerification extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'otp_verifications';

    protected $fillable = [
        'id',
        'numero_telephone',
        'code_otp',
        'expiration',
        'utilise',
    ];

    protected $casts = [
        'expiration' => 'datetime',
        'utilise' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
        });
    }

    // helper
    public function isValid()
    {
        return !$this->utilise && Carbon::now()->lt($this->expiration);
    }
}
