<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class UniqueMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::UNIQUE;
}
