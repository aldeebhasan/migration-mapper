<?php

namespace Aldeebhasan\Emigrate\Enums;

enum ColumnTypeEnum: string
{
    case BOOLEAN = 'boolean';
    case INTEGER = 'integer';
    case DATETIME = 'dateTime';
    case DECIMAL = 'decimal';
    case DOUBLE = 'double';
    case FLOAT = 'float';
    case STRING = 'string';
    case SOFT_DELETE = 'softDeletes';
    case DATE = 'date';
    case TIME = 'time';
    case ID = 'id';
    case TEXT = 'text';
    case ENUM = 'enum';
    case TIMESTAMPS = 'timestamps';
    case TIMESTAMP = 'timestamp';
    case DROP_COLUMN = 'dropColumn';
    case FOREIGN = 'foreign';
    case DROP_FOREIGN = 'dropForeign';

}
