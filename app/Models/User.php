<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @method static create(array $userData)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'Users';

    /**
     * @var string
     */
    protected $primaryKey = 'userID';

    /**
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'ddd',
        'telefone',
        'email',
        'endereco',
        'avatar',
        'sysAdmin',
        'password',
    ];

    protected $visible = [
        'userID',
        'nome',
        'ddd',
        'telefone',
        'email',
        'endereco',
        'avatar',
        'sysAdmin',
    ];

    /**
     * Custom created_at
     */
    const CREATED_AT = 'DateIns';

    /**
     * Custom updated_at
     */
    const UPDATED_AT = 'DateUpd';
}
