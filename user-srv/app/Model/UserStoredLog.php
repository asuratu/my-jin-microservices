<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class UserStoredLog extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected ?string $dateFormat = 'U';
    /**
     * The table associated with the model.
     *
     * @var ?string
     */
    protected ?string $table = 'user_stored_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'user_id',
        'type',
        'amount',
        'source',
        'remark',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected array $casts = ['id' => 'integer'];
}
