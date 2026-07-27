<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Event\EventTypeEnum;
use App\Enums\General\PublicationStatusEnum;
use App\QueryBuilders\EventQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Event extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'events';

    public final const string ID = 'id';
    public final const string SLUG = 'slug';
    public final const string TYPE = 'type';
    public final const string STATUS = 'status';
    public final const string TITLE = 'title';
    public final const string DESCRIPTION = 'description';
    public final const string PLACE = 'place';
    public final const string REGISTRATION_URL = 'registration_url';
    public final const string STARTS_AT = 'starts_at';
    public final const string ENDS_AT = 'ends_at';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::SLUG,
        self::TYPE,
        self::STATUS,
        self::TITLE,
        self::DESCRIPTION,
        self::PLACE,
        self::REGISTRATION_URL,
        self::STARTS_AT,
        self::ENDS_AT,
    ];

    protected $attributes = [
        self::STATUS => PublicationStatusEnum::DRAFT->value,
    ];

    protected function casts(): array
    {
        return [
            self::TYPE => EventTypeEnum::class,
            self::STATUS => PublicationStatusEnum::class,
            self::STARTS_AT => 'datetime',
            self::ENDS_AT => 'datetime',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): EventQueryBuilder
    {
        return new EventQueryBuilder($query);
    }
}
