<?php

namespace Aldeebhasan\MigrationMapper\Enums;

enum RelationTypeEnum: string
{
    case ONE_TO_MANY = 'one-to-many';
    case ONE_TO_ONE = 'one-to-one';
    case MANY_TO_MANY = 'many-to-many';
    case MANY_TO_ONE = 'many-to-one';

}
