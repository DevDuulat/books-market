<?php

namespace App\Enums;

enum OrderStatus: int
{
    case New = 0;
    case Completed = 1;
    case Cancelled = 2;

    public function label(): string
    {
        return match($this) {
            self::New => 'Жаңы',
            self::Completed => 'Бүттү',
            self::Cancelled => 'Жокко чыгарылды',
        };
    }
}
