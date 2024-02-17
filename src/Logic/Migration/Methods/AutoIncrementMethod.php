<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class AutoIncrementMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::AUTOINCREMENT;
}
