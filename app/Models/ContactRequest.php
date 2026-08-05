<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Contact\ContactTopicEnum;
use App\Enums\General\ApplicationStatusEnum;
use App\QueryBuilders\ContactRequestQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ContactRequest extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'contact_requests';

    public final const string ID = 'id';
    public final const string TOPIC = 'topic';
    public final const string STATUS = 'status';
    public final const string NAME = 'name';
    public final const string EMAIL = 'email';
    public final const string PHONE = 'phone';
    public final const string MESSAGE = 'message';
    public final const string CONSENT_AT = 'consent_at';
    public final const string MARKETING_CONSENT = 'marketing_consent';
    public final const string MANAGER_COMMENT = 'manager_comment';
    public final const string PROCESSED_AT = 'processed_at';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::TOPIC,
        self::STATUS,
        self::NAME,
        self::EMAIL,
        self::PHONE,
        self::MESSAGE,
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
            self::TOPIC => ContactTopicEnum::class,
            self::STATUS => ApplicationStatusEnum::class,
            self::MARKETING_CONSENT => 'boolean',
            self::CONSENT_AT => 'datetime',
            self::PROCESSED_AT => 'datetime',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): ContactRequestQueryBuilder
    {
        return new ContactRequestQueryBuilder($query);
    }
}
