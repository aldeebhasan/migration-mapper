<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class NullableMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::NULLABLE;
}
