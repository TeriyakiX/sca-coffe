<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Accreditation\AccreditationTypeEnum;
use App\Enums\General\ApplicationStatusEnum;
use App\QueryBuilders\AccreditationApplicationQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class AccreditationApplication extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'accreditation_applications';

    public final const string ID = 'id';
    public final const string TYPE = 'type';
    public final const string STATUS = 'status';
    public final const string ORGANIZATION = 'organization';
    public final const string INN = 'inn';
    public final const string CITY = 'city';
    public final const string CONTACT_NAME = 'contact_name';
    public final const string CONTACT_POSITION = 'contact_position';
    public final const string EMAIL = 'email';
    public final const string PHONE = 'phone';
    public final const string SITE_URL = 'site_url';
    public final const string PROGRAMS = 'programs';
    public final const string FACILITIES = 'facilities';
    public final const string EXPERIENCE = 'experience';
    public final const string TRAINERS_COUNT = 'trainers_count';
    public final const string COMMENT = 'comment';
    public final const string CONSENT_AT = 'consent_at';
    public final const string MARKETING_CONSENT = 'marketing_consent';
    public final const string MANAGER_COMMENT = 'manager_comment';
    public final const string PROCESSED_AT = 'processed_at';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::TYPE,
        self::STATUS,
        self::ORGANIZATION,
        self::INN,
        self::CITY,
        self::CONTACT_NAME,
        self::CONTACT_POSITION,
        self::EMAIL,
        self::PHONE,
        self::SITE_URL,
        self::PROGRAMS,
        self::FACILITIES,
        self::EXPERIENCE,
        self::TRAINERS_COUNT,
        self::COMMENT,
        self::CONSENT_AT,
        self::MARKETING_CONSENT,
        self::MANAGER_COMMENT,
        self::PROCESSED_AT,
    ];

    protected $attributes = [
        self::STATUS => ApplicationStatusEnum::NEW->value,
    ];

    protected function casts(): array
    {
        return [
            self::TYPE => AccreditationTypeEnum::class,
            self::STATUS => ApplicationStatusEnum::class,
            self::MARKETING_CONSENT => 'boolean',
            self::CONSENT_AT => 'datetime',
            self::PROCESSED_AT => 'datetime',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): AccreditationApplicationQueryBuilder
    {
        return new AccreditationApplicationQueryBuilder($query);
    }
}
