<?php

namespace Aldeebhasan\MigrationMapper\Enums;

enum ColumnTypeEnum: string
{
    case BOOLEAN = 'boolean';
    case TINY_INTEGER = 'tinyInteger';
    case SMALL_INTEGER = 'smallInteger';
    case INTEGER = 'integer';
    case MEDIUM_INTEGER = 'mediumInteger';
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
    case TINY_TEXT = 'tinyText';
    case TEXT = 'text';
    case MEDIUM_TEXT = 'mediumText';
    case LONG_TEXT = 'longText';
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
