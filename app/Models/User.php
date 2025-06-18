<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'sexo',
        'data_nascimento',
        'local_nascimento',
        'telefone',
        'celular',
        'pais_sigla',
        'zip_code',
        'cidade',
        'endereco',
        'numero_identificacao',
        'tipo_usuario_id',
        'stripe_id',
        'password',
        'numero_carta_conducao',
        'local_emissao_carta_conducao',
        'pais_emissao_carta_conducao',
        'data_emissao_carta_conducao',
        'data_validade_carta_conducao'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tipoUsuario()
    {
        return $this->belongsTo(Regra::class, 'tipo_usuario_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function defaultPaymentMethod()
    {
        return $this->defaultPaymentMethod();
    }
}
