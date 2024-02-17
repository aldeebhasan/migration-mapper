<?php

namespace Aldeebhasan\MigrationMapper\Test\Unit\Models;

use Aldeebhasan\MigrationMapper\Attributes\Columns\Column;
use Aldeebhasan\MigrationMapper\Attributes\Columns\Enum;
use Aldeebhasan\MigrationMapper\Attributes\Columns\Id;
use Aldeebhasan\MigrationMapper\Attributes\Columns\Integer;
use Aldeebhasan\MigrationMapper\Attributes\Columns\String_;
use Aldeebhasan\MigrationMapper\Attributes\Table;
use Aldeebhasan\MigrationMapper\Attributes\Relations\{ManyToMany, ManyToOne, OneToMany, OneToOne};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Table(
    name: 'y_models',
    columns: [
        new Id('id'),
        new String_('name', 255, nullable: true, default: "Hi there"),
        new Integer('user_id', nullable: true, default: 0, index: true, unsigned: true),
        new Enum('status', ['draft', 'pend'], nullable: true, default: 'pend', index: true, comment: 'status col'),
    ]
)]
class YModel extends Model
{

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

}