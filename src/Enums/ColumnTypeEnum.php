<?php

namespace Aldeebhasan\Emigrate\Enums;

enum ColumnTypeEnum: string
{
    case BOOLEAN = 'boolean';
    case INTEGER = 'integer';
    case BIG_INTEGER = 'bigInteger';
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
    case FOREIGN = 'foreign';
    case FOREIGN_ID = 'foreignId';
    case FOREIGN_ID_FOR = 'foreignIdFor';
    case DROP_COLUMN = 'dropColumn';
    case DROP_INDEX = 'dropIndex';
    case DROP_FULLTEXT = 'dropFulltext';
    case DROP_UNIQUE = 'dropUnique';
    case DROP_FOREIGN = 'dropForeign';

}
