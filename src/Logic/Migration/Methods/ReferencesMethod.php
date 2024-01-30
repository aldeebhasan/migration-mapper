<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class ReferencesMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::REFERENCES;
}
