<?php

namespace App\Enums;

enum OrderStatus: int
{
    case Pending = 0;
    case Processing = 1;
    case Completed = 2;
    case Cancelled = 3;

    public function label(): string
    {
        return match($this) {
            self::Pending => 'В ожидании',
            self::Processing => 'В обработке',
            self::Completed => 'Завершён',
            self::Cancelled => 'Отменён',
        };
    }
}
