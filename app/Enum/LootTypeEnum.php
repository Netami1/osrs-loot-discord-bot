<?php

namespace App\Enum;

enum LootTypeEnum: string
{
    case ALWAYS = 'always';
    case PRIMARY = 'primary';
    case TERTIARY = 'tertiary';
    case RAID_UNIQUE = 'raid_unique';
    case RAID_PET = 'raid_pet';
}
