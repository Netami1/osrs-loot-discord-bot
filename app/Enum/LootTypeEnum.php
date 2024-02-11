<?php

namespace App\Enum;

enum LootTypeEnum: string
{
    case ALWAYS = 'always';
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case TERTIARY = 'tertiary';
    case PET = 'pet';
}
