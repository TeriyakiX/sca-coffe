<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\General\PublicationStatusEnum;
use App\QueryBuilders\PageQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Page extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'pages';

    public final const string ID = 'id';
    public final const string SLUG = 'slug';
    public final const string STATUS = 'status';
    public final const string TITLE = 'title';
    public final const string CONTENT = 'content';
    public final const string SORT_ORDER = 'sort_order';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::SLUG,
        self::STATUS,
        self::TITLE,
        self::CONTENT,
        self::SORT_ORDER,
    ];

    protected $attributes = [
        self::STATUS => PublicationStatusEnum::PUBLISHED->value,
        self::SORT_ORDER => 0,
    ];

    protected function casts(): array
    {
        return [
            self::STATUS => PublicationStatusEnum::class,
            self::SORT_ORDER => 'integer',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): PageQueryBuilder
    {
        return new PageQueryBuilder($query);
    }
}
