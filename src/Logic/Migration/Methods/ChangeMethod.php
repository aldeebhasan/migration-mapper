<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class ChangeMethod extends GeneralMethod
{

    protected MethodTypeEnum $type = MethodTypeEnum::CHANGE;

}