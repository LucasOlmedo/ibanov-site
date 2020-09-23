<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Models
 */
class Event extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'Agenda';

    /**
     * @var string
     */
    protected $primaryKey = 'agendaID';

    /**
     * Custom created_at
     */
    const CREATED_AT = 'DateIns';

    /**
     * Custom updated_at
     */
    const UPDATED_AT = 'DateUpd';

    /**
     * Custom deleted_at
     */
    const DELETED_AT = 'Deleted';

    /**
     * @var string[]
     */
    protected $dates = [
        'DateIns',
        'DateUpd',
        'Deleted',
    ];
}
