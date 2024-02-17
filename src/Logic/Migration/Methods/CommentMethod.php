<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class CommentMethod extends GeneralMethod
{
    protected MethodTypeEnum $type = MethodTypeEnum::COMMENT;
}
