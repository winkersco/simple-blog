<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
enum PublicationStatus: int
{
    use Names, Values;

    case DRAFT = 1;

    case PUBLISH = 2;
}
