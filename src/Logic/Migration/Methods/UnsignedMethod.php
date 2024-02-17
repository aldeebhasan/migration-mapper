<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class UnsignedMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::UNSIGNED;
}
