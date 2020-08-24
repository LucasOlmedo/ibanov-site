<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @property mixed DateIns
 * @package App\Models
 * @method static create(array $params)
 * @method static findOrFail(int $id)
 */
class Post extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'Depoimentos';

    /**
     * @var string
     */
    protected $primaryKey = 'depoimentoID';

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
    protected $dates = [
        'DateIns',
        'DateUpd',
        'deleted_at',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'userID',
        'imagem',
        'titulo',
        'Texto',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'depoimentoID',
        'userID',
        'imagem',
        'titulo',
        'Texto',
        'DateIns',
        'DateUpd',
        'user', // relation
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
