<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Content\ContentSectionEnum;
use App\QueryBuilders\ContentBlockQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ContentBlock extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'content_blocks';

    public final const string ID = 'id';
    public final const string KEY = 'key';
    public final const string SECTION = 'section';
    public final const string TITLE = 'title';
    public final const string SUBTITLE = 'subtitle';
    public final const string BODY = 'body';
    public final const string ITEMS = 'items';
    public final const string SORT_ORDER = 'sort_order';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::KEY,
        self::SECTION,
        self::TITLE,
        self::SUBTITLE,
        self::BODY,
        self::ITEMS,
        self::SORT_ORDER,
    ];

    protected $attributes = [
        self::SORT_ORDER => 0,
    ];

    protected function casts(): array
    {
        return [
            self::SECTION => ContentSectionEnum::class,
            self::ITEMS => 'array',
            self::SORT_ORDER => 'integer',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): ContentBlockQueryBuilder
    {
        return new ContentBlockQueryBuilder($query);
    }
}
