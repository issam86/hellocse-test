<?php

namespace Domain\Profile\Enums;

enum ProfileStatus: string
{
    case Active = 'actif';
    case Inactive = 'inactive';
    case Pending = 'en_attente';
}
