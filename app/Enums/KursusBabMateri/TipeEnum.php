<?php

namespace App\Enums\KursusBabMateri;

enum TipeEnum: string 
{
    case VIDEO = 'video';
    case TEXT = 'text';

    public function getLabel(): string
    {
        return match ($this) {
            self::VIDEO => 'Video',
            self::TEXT => 'Text',
        };
    }
}
