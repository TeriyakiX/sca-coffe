<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\General\ApplicationStatusEnum;
use App\Enums\Membership\MembershipCategoryEnum;
use App\Enums\Membership\MembershipSpecializationEnum;
use App\QueryBuilders\MembershipApplicationQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class MembershipApplication extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'membership_applications';

    public final const string ID = 'id';
    public final const string CATEGORY = 'category';
    public final const string SPECIALIZATION = 'specialization';
    public final const string STATUS = 'status';
    public final const string NAME = 'name';
    public final const string EMAIL = 'email';
    public final const string PHONE = 'phone';
    public final const string CITY = 'city';
    public final const string COMPANY = 'company';
    public final const string ABOUT = 'about';
    public final const string MANAGER_COMMENT = 'manager_comment';
    public final const string PROCESSED_AT = 'processed_at';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::CATEGORY,
        self::SPECIALIZATION,
        self::STATUS,
        self::NAME,
        self::EMAIL,
        self::PHONE,
        self::CITY,
        self::COMPANY,
        self::ABOUT,
        self::MANAGER_COMMENT,
        self::PROCESSED_AT,
    ];

    protected $attributes = [
        self::STATUS => ApplicationStatusEnum::NEW->value,
    ];

    protected function casts(): array
    {
        return [
            self::CATEGORY => MembershipCategoryEnum::class,
            self::SPECIALIZATION => MembershipSpecializationEnum::class,
            self::STATUS => ApplicationStatusEnum::class,
            self::PROCESSED_AT => 'datetime',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): MembershipApplicationQueryBuilder
    {
        return new MembershipApplicationQueryBuilder($query);
    }
}
