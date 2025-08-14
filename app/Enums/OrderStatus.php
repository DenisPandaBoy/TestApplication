<?php

namespace App\Enums;

enum OrderStatus: string
{
    case NEW = 'new';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';

    public function name(): string
    {
        return match ($this) {
            self::NEW => "New",
            self::PROCESSING => "Processing",
            self::COMPLETED => "Completed",
        };
    }

    public function color(): string{
        return match ($this) {
            self::NEW => "#ff7d00",
            self::PROCESSING => "#0000ff",
            self::COMPLETED => "#00ff00",
        };
    }
}
