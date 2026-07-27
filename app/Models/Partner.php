<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\General\PublicationStatusEnum;
use App\Enums\Partner\PartnerCategoryEnum;
use App\QueryBuilders\PartnerQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Partner extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'partners';

    public final const string ID = 'id';
    public final const string SLUG = 'slug';
    public final const string CATEGORY = 'category';
    public final const string STATUS = 'status';
    public final const string NAME = 'name';
    public final const string DESCRIPTION = 'description';
    public final const string BENEFIT = 'benefit';
    public final const string LOGO_URL = 'logo_url';
    public final const string SITE_URL = 'site_url';
    public final const string SORT_ORDER = 'sort_order';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::SLUG,
        self::CATEGORY,
        self::STATUS,
        self::NAME,
        self::DESCRIPTION,
        self::BENEFIT,
        self::LOGO_URL,
        self::SITE_URL,
        self::SORT_ORDER,
    ];

    protected $attributes = [
        self::STATUS => PublicationStatusEnum::DRAFT->value,
        self::SORT_ORDER => 0,
    ];

    protected function casts(): array
    {
        return [
            self::CATEGORY => PartnerCategoryEnum::class,
            self::STATUS => PublicationStatusEnum::class,
            self::SORT_ORDER => 'integer',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): PartnerQueryBuilder
    {
        return new PartnerQueryBuilder($query);
    }
}
