<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
enum PublicationStatus: int
{
    use Names, Values, Options;

    case DRAFT = 1;

    case PUBLISH = 2;
}
