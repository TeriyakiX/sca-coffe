<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Accreditation\AccreditationTypeEnum;
use App\Enums\Contact\ContactTopicEnum;
use App\Enums\General\ApplicationStatusEnum;
use App\Enums\Membership\MembershipCategoryEnum;
use App\Enums\Membership\MembershipSpecializationEnum;
use App\Models\AccreditationApplication;
use App\Models\ContactRequest;
use App\Models\MembershipApplication;
use Illuminate\Database\Seeder;

final class DemoApplicationSeeder extends Seeder
{
    public final function run(): void
    {
        foreach ($this->membership() as $item) {
            MembershipApplication::query()->updateOrCreate(
                [MembershipApplication::EMAIL => $item[MembershipApplication::EMAIL]],
                $item,
            );
        }

        foreach ($this->accreditation() as $item) {
            AccreditationApplication::query()->updateOrCreate(
                [AccreditationApplication::EMAIL => $item[AccreditationApplication::EMAIL]],
                $item,
            );
        }

        foreach ($this->contacts() as $item) {
            ContactRequest::query()->updateOrCreate(
                [ContactRequest::EMAIL => $item[ContactRequest::EMAIL]],
                $item,
            );
        }
    }

    private function membership(): array
    {
        return [
            [
                MembershipApplication::CATEGORY => MembershipCategoryEnum::INDIVIDUAL->value,
                MembershipApplication::SPECIALIZATION => MembershipSpecializationEnum::BARISTA->value,
                MembershipApplication::STATUS => ApplicationStatusEnum::NEW->value,
                MembershipApplication::NAME => 'Демидова Анна Сергеевна',
                MembershipApplication::EMAIL => 'demo.barista@example.ru',
                MembershipApplication::PHONE => '+7 999 100-20-30',
                MembershipApplication::CITY => 'Москва',
                MembershipApplication::COMPANY => 'Кофейня «Зерно»',
                MembershipApplication::ABOUT => 'Работаю бариста четыре года, интересует участие в рабочей группе по стандарту бариста.',
            ],
            [
                MembershipApplication::CATEGORY => MembershipCategoryEnum::CORPORATE->value,
                MembershipApplication::SPECIALIZATION => MembershipSpecializationEnum::ROASTER->value,
                MembershipApplication::STATUS => ApplicationStatusEnum::IN_REVIEW->value,
                MembershipApplication::NAME => 'ООО «Северная обжарка»',
                MembershipApplication::EMAIL => 'demo.roastery@example.ru',
                MembershipApplication::PHONE => '+7 999 200-30-40',
                MembershipApplication::CITY => 'Санкт-Петербург',
                MembershipApplication::COMPANY => 'Северная обжарка',
                MembershipApplication::ABOUT => 'Обжарочное производство, десять сотрудников. Интересует корпоративное членство и обучение персонала.',
                MembershipApplication::MANAGER_COMMENT => 'Запросили реквизиты и перечень сотрудников.',
            ],
            [
                MembershipApplication::CATEGORY => MembershipCategoryEnum::TRAINING_CENTER->value,
                MembershipApplication::SPECIALIZATION => MembershipSpecializationEnum::TRAINING_CENTER->value,
                MembershipApplication::STATUS => ApplicationStatusEnum::APPROVED->value,
                MembershipApplication::NAME => 'Школа кофе «Практика»',
                MembershipApplication::EMAIL => 'demo.school@example.ru',
                MembershipApplication::PHONE => '+7 999 300-40-50',
                MembershipApplication::CITY => 'Казань',
                MembershipApplication::COMPANY => 'Практика',
                MembershipApplication::ABOUT => 'Учебный центр, три программы подготовки бариста и один тренер по чаю.',
                MembershipApplication::MANAGER_COMMENT => 'Принят, направлены условия участия.',
                MembershipApplication::PROCESSED_AT => now()->subDays(3),
            ],
        ];
    }

    private function accreditation(): array
    {
        return [
            [
                AccreditationApplication::TYPE => AccreditationTypeEnum::TRAINING_CENTER->value,
                AccreditationApplication::STATUS => ApplicationStatusEnum::NEW->value,
                AccreditationApplication::ORGANIZATION => 'Школа кофе «Практика»',
                AccreditationApplication::INN => '7701234567',
                AccreditationApplication::CITY => 'Казань',
                AccreditationApplication::CONTACT_NAME => 'Иванов Пётр',
                AccreditationApplication::CONTACT_POSITION => 'Руководитель',
                AccreditationApplication::EMAIL => 'demo.accredit@example.ru',
                AccreditationApplication::PHONE => '+7 999 400-50-60',
                AccreditationApplication::SITE_URL => 'https://example.ru',
                AccreditationApplication::PROGRAMS => 'Бариста базовый уровень, латте-арт, основы обжарки.',
                AccreditationApplication::FACILITIES => 'Две учебные площадки, шесть рабочих мест, эспрессо-машины и каппинг-зона.',
            ],
            [
                AccreditationApplication::TYPE => AccreditationTypeEnum::TRAINER->value,
                AccreditationApplication::STATUS => ApplicationStatusEnum::IN_REVIEW->value,
                AccreditationApplication::ORGANIZATION => 'ИП Смирнова Е. А.',
                AccreditationApplication::CITY => 'Екатеринбург',
                AccreditationApplication::CONTACT_NAME => 'Смирнова Елена',
                AccreditationApplication::CONTACT_POSITION => 'Тренер',
                AccreditationApplication::EMAIL => 'demo.trainer@example.ru',
                AccreditationApplication::PHONE => '+7 999 500-60-70',
                AccreditationApplication::PROGRAMS => 'Подготовка бариста, чайные дегустации.',
                AccreditationApplication::MANAGER_COMMENT => 'Ожидаем подтверждение опыта работы.',
            ],
        ];
    }

    private function contacts(): array
    {
        return [
            [
                ContactRequest::TOPIC => ContactTopicEnum::PARTNERSHIP->value,
                ContactRequest::STATUS => ApplicationStatusEnum::NEW->value,
                ContactRequest::NAME => 'Компания «Тех-Кофе»',
                ContactRequest::EMAIL => 'demo.partner@example.ru',
                ContactRequest::MESSAGE => 'Поставляем оборудование для кофеен, хотим обсудить партнёрскую программу для членов Ассоциации.',
            ],
            [
                ContactRequest::TOPIC => ContactTopicEnum::WORKING_GROUP->value,
                ContactRequest::STATUS => ApplicationStatusEnum::IN_REVIEW->value,
                ContactRequest::NAME => 'Кузнецов Алексей',
                ContactRequest::EMAIL => 'demo.expert@example.ru',
                ContactRequest::MESSAGE => 'Технолог кофейного производства, хочу войти в рабочую группу по стандарту обжарщика.',
                ContactRequest::MANAGER_COMMENT => 'Направлена анкета эксперта.',
            ],
        ];
    }
}
