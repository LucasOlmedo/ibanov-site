<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property mixed sysAdmin
 * @package App\Models
 * @method static create(array $userData)
 * @method static findOrFail(int $id)
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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

    /**
     * @var string[]
     */
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

    /**
     * @var string[]
     */
    protected $casts = [
        'sysAdmin' => 'boolean',
    ];

    /**
     * @return mixed|bool
     */
    public function isAdmin()
    {
        return (bool)$this->sysAdmin;
    }
}
