<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\HasMany;
use Hyperf\DbConnection\Model\Model;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;
use Qbhy\HyperfAuth\AuthAbility;
use Qbhy\HyperfAuth\Authenticatable;

class User extends Model implements Authenticatable, CacheableInterface
{
    use AuthAbility, Cacheable;

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected ?string $dateFormat = 'U';
    /**
     * The table associated with the model.
     *
     * @var ?string
     */
    protected ?string $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'user_name',
        'user_image',
        'phone',
        'sex',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected array $casts = ['id' => 'integer'];

    // repository
    protected $repository = UserRepository::class;

    public function bonus(): HasMany
    {
        return $this->hasMany(UserBonusLog::class, 'user_id', 'id');
    }

    public function stored(): HasMany
    {
        return $this->hasMany(UserStoredLog::class, 'user_id', 'id');
    }
}
