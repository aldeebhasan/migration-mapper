<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class ChangeMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::CHANGE;
}
