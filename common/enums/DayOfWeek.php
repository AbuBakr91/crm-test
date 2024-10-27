<?php

namespace common\enums;

enum DayOfWeek: string
{
    case MONDAY = 'Понедельник';
    case TUESDAY = 'Вторник';
    case WEDNESDAY = 'Среда';
    case THURSDAY = 'Четверг';
    case FRIDAY = 'Пятница';
    case SATURDAY = 'Суббота';
    case SUNDAY = 'Воскресенье';

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}