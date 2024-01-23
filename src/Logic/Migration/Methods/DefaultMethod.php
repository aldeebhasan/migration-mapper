<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class DefaultMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::DEFAULT;
}
