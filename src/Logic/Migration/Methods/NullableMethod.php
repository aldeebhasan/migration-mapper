<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class NullableMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::NULLABLE;
}
