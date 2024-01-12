<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class AutoIncrementMethod extends GeneralMethod
{

    protected MethodTypeEnum $type = MethodTypeEnum::AUTOINCREMENT;

}