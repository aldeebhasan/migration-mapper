<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class OnMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::ON;
}
