<?php

namespace App;

enum BannerStatus: int
{
    case Active = 1;
    case Inactive = 0;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Активен',
            self::INACTIVE => 'Неактивен',
        };
    }

    public static function options(): array
    {
        return [
            self::Active->value => self::Active->label(),
            self::Inactive->value => self::Inactive->label(),
        ];
    }
}
