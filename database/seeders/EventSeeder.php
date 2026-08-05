<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Event\EventTypeEnum;
use App\Enums\General\PublicationStatusEnum;
use App\Models\Event;
use Database\Seeders\Concerns\UpsertsSoftDeleted;
use Illuminate\Database\Seeder;

final class EventSeeder extends Seeder
{
    use UpsertsSoftDeleted;

    public final function run(): void
    {
        foreach ($this->items() as $item) {
            $this->upsertRecord(Event::class, [Event::SLUG => $item[Event::SLUG]], $item);
        }
    }

    private function items(): array
    {
        return [
            [
                Event::SLUG => 'ustanovochnaya-vstrecha-rabochih-grupp',
                Event::TYPE => EventTypeEnum::WORKING_GROUP->value,
                Event::STATUS => PublicationStatusEnum::PUBLISHED->value,
                Event::TITLE => 'Установочная встреча рабочих групп',
                Event::PLACE => 'Москва',
                Event::STARTS_AT => '2026-09-12 10:00:00',
            ],
            [
                Event::SLUG => 'konferenciya-po-profstandartam',
                Event::TYPE => EventTypeEnum::CONFERENCE->value,
                Event::STATUS => PublicationStatusEnum::PUBLISHED->value,
                Event::TITLE => 'Отраслевая конференция по профстандартам',
                Event::PLACE => 'Москва',
                Event::STARTS_AT => '2026-10-08 10:00:00',
            ],
            [
                Event::SLUG => 'seminar-dlya-uchebnyh-centrov',
                Event::TYPE => EventTypeEnum::SEMINAR->value,
                Event::STATUS => PublicationStatusEnum::PUBLISHED->value,
                Event::TITLE => 'Семинар для учебных центров: подготовка к аккредитации',
                Event::PLACE => 'Онлайн',
                Event::STARTS_AT => '2026-11-20 11:00:00',
            ],
        ];
    }
}
