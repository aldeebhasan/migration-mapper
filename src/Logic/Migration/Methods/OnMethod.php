<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class OnMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::ON;
}
