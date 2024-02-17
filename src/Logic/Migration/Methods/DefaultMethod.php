<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class DefaultMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::DEFAULT;
}
