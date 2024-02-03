<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class FulltextMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::FULLTEXT;
}
