<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class IndexMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::INDEX;
}
