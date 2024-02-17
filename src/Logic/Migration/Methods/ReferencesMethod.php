<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class ReferencesMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::REFERENCES;
}
