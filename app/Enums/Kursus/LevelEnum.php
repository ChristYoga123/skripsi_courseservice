<?php

namespace App\Enums\Kursus;

enum LevelEnum: string 
{
    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';

    public function getLabel(): string
    {
        return match ($this) {
            self::BEGINNER => 'Beginner',
            self::INTERMEDIATE => 'Intermediate',
            self::ADVANCED => 'Advanced',
        };
    }
}
