<?php

declare(strict_types=1);

namespace App\Services\Seo;

use App\Enums\General\PublicationStatusEnum;
use App\Models\News;
use App\Models\Page;

final class MetaResolver
{
    /**
     * Собирает мета-теги для запрошенного пути.
     * Статические страницы берутся из config/seo.php, новости и страницы «Сведений» — из базы.
     *
     * @return array{title: string, description: string, url: string, type: string, site_name: string}
     */
    public final function resolve(string $path, string $url): array
    {
        $path = '/' . trim($path, '/');
        $path = $path === '/' ? '/' : rtrim($path, '/');

        $meta = $this->fromNews($path)
            ?? $this->fromPage($path)
            ?? $this->fromConfig($path);

        return [
            'title' => $meta['title'],
            'description' => $meta['description'],
            'type' => $meta['type'] ?? 'website',
            'url' => $url,
            'site_name' => (string) config('seo.site_name'),
        ];
    }

    private function fromConfig(string $path): array
    {
        $pages = (array) config('seo.pages', []);

        return $pages[$path] ?? (array) config('seo.default');
    }

    private function fromNews(string $path): array|null
    {
        if (!preg_match('~^/news/([A-Za-z0-9\-]+)$~', $path, $matches)) {
            return null;
        }

        $news = News::query()
            ->where(News::SLUG, $matches[1])
            ->where(News::STATUS, PublicationStatusEnum::PUBLISHED->value)
            ->first([News::TITLE, News::EXCERPT]);

        if (!$news) {
            return null;
        }

        return [
            'title' => $news->{News::TITLE},
            'description' => $this->shorten((string) $news->{News::EXCERPT}),
            'type' => 'article',
        ];
    }

    private function fromPage(string $path): array|null
    {
        if (!preg_match('~^/page/([A-Za-z0-9\-]+)$~', $path, $matches)) {
            return null;
        }

        $page = Page::query()
            ->where(Page::SLUG, $matches[1])
            ->where(Page::STATUS, PublicationStatusEnum::PUBLISHED->value)
            ->first([Page::TITLE, Page::CONTENT]);

        if (!$page) {
            return null;
        }

        return [
            'title' => $page->{Page::TITLE},
            'description' => $this->shorten(strip_tags((string) $page->{Page::CONTENT})),
        ];
    }

    private function shorten(string $text, int $limit = 200): string
    {
        $text = trim(preg_replace('/\s+/u', ' ', $text) ?? '');

        if ($text === '') {
            return (string) config('seo.default.description');
        }

        return mb_strlen($text) > $limit
            ? mb_substr($text, 0, $limit - 1) . '…'
            : $text;
    }
}
