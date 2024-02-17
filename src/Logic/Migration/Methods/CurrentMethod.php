<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class CurrentMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::USE_CURRENT;
}
