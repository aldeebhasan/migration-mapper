<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class FulltextMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::FULLTEXT;
}
