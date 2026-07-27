<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\General\PublicationStatusEnum;
use App\Enums\Partner\PartnerCategoryEnum;
use App\Models\Partner;
use Illuminate\Database\Seeder;

final class PartnerSeeder extends Seeder
{
    public final function run(): void
    {
        foreach ($this->items() as $item) {
            Partner::query()->updateOrCreate([Partner::SLUG => $item[Partner::SLUG]], $item);
        }
    }

    private function items(): array
    {
        return [
            [
                Partner::SLUG => 'partner-oborudovanie',
                Partner::CATEGORY => PartnerCategoryEnum::EQUIPMENT->value,
                Partner::STATUS => PublicationStatusEnum::DRAFT->value,
                Partner::NAME => 'Раздел в стадии формирования',
                Partner::DESCRIPTION => 'Идёт подключение первых партнёров отрасли.',
                Partner::BENEFIT => 'Специальные условия для членов Ассоциации.',
                Partner::SORT_ORDER => 10,
            ],
        ];
    }
}
