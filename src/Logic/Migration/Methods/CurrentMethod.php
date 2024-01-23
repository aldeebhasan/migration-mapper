<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class CurrentMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::USE_CURRENT;
}
