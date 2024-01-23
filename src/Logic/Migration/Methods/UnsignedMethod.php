<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class UnsignedMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::UNSIGNED;
}
