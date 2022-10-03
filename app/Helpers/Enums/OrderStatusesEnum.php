<?php

namespace App\Helpers\Enums;

enum OrderStatusesEnum: string {

    case InProcess = 'In Process';
    case Paid = 'Paid';
    case Completed = 'Completed';
    case Canseled = 'canseled';

    public static function findByKey(string $key) {
        return constant("self::$key");
    }
}
