<?php

namespace App\Enums\Kursus;

enum TipeEnum: string 
{
    case FREE = 'free';
    case PREMIUM = 'premium';

    public function getLabel(): string
    {
        return match ($this) {
            self::FREE => 'Free',
            self::PREMIUM => 'Premium',
        };
    }
}
