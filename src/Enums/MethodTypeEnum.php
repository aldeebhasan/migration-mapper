<?php

namespace Aldeebhasan\Emigrate\Enums;

enum MethodTypeEnum: string
{
    case DEFAULT = 'default';
    case NULLABLE = 'nullable';
    case INDEX = 'index';
    case UNSIGNED = 'unsigned';
    case AUTOINCREMENT = 'autoIncrement';
    case COMMENT = 'comment';
    case UNIQUE = 'unique';
    case USE_CURRENT = 'useCurrent';
    case CHANGE = 'change';

}
