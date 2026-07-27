<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\General\PublicationStatusEnum;
use App\Enums\News\NewsCategoryEnum;
use App\QueryBuilders\NewsQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class News extends Model
{
    use HasUuids,
        SoftDeletes;

    public final const string DATABASE_TABLE = 'news';

    public final const string ID = 'id';
    public final const string SLUG = 'slug';
    public final const string CATEGORY = 'category';
    public final const string STATUS = 'status';
    public final const string TITLE = 'title';
    public final const string EXCERPT = 'excerpt';
    public final const string CONTENT = 'content';
    public final const string COVER_URL = 'cover_url';
    public final const string PUBLISHED_AT = 'published_at';
    public final const string CREATED_AT = 'created_at';
    public final const string UPDATED_AT = 'updated_at';
    public final const string DELETED_AT = 'deleted_at';

    protected $table = self::DATABASE_TABLE;

    protected $fillable = [
        self::SLUG,
        self::CATEGORY,
        self::STATUS,
        self::TITLE,
        self::EXCERPT,
        self::CONTENT,
        self::COVER_URL,
        self::PUBLISHED_AT,
    ];

    protected $attributes = [
        self::STATUS => PublicationStatusEnum::DRAFT->value,
    ];

    protected function casts(): array
    {
        return [
            self::CATEGORY => NewsCategoryEnum::class,
            self::STATUS => PublicationStatusEnum::class,
            self::PUBLISHED_AT => 'datetime',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
            self::DELETED_AT => 'datetime',
        ];
    }

    public final function newEloquentBuilder($query): NewsQueryBuilder
    {
        return new NewsQueryBuilder($query);
    }
}
