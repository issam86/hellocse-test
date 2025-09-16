<?php

namespace Domain\Profile\Enums;

enum ProfileStatus: string
{
    case Active = 'actif';
    case Inactive = 'inactif';
    case Pending = 'en_attente';
}
