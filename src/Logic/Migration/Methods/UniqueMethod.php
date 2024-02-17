<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class UniqueMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::UNIQUE;
}
