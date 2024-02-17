<?php

namespace Aldeebhasan\Emigrate\Test\Unit\Models;

use Aldeebhasan\Emigrate\Attributes\Columns\Column;
use Aldeebhasan\Emigrate\Attributes\Columns\Enum;
use Aldeebhasan\Emigrate\Attributes\Columns\Id;
use Aldeebhasan\Emigrate\Attributes\Columns\Integer;
use Aldeebhasan\Emigrate\Attributes\Columns\String_;
use Aldeebhasan\Emigrate\Attributes\Table;
use Aldeebhasan\Emigrate\Attributes\Relations\{ManyToMany, ManyToOne, OneToMany, OneToOne};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Table(
    name: 'x_models',
    columns: [
        new Id('id'),
        new String_('name', 255, nullable: true, default: "Hi there"),
        new Integer('user_id', nullable: true, default: 0, index: true, unsigned: true),
        new Enum('status', ['draft', 'pend'], nullable: true, default: 'pend', index: true, comment: 'status col'),
    ]
)]
class XModel extends Model
{

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    #[OneToMany(related: XModel::class, foreignKey: 'parent_id', localKey: 'id')]
    public function children(): HasMany
    {
        return $this->hasMany(XModel::class, 'parent_id');
    }

//    #[OneToOne(related: XModel::class, foreignKey: 'parent_id', localKey: 'id')]
//    public function hol(): HasOne
//    {
//        return $this->hasOne(XModel::class, 'parent_id');
//    }

//    #[ManyToOne(related: XModel::class, foreignKey: 'parent_id', ownerKey: 'id')]
//    public function parent(): BelongsTo
//    {
//        return $this->belongsTo(XModel::class, 'parent_id');
//    }

    #[ManyToOne(related: XModel::class, foreignKey: 'user_id', ownerKey: 'id')]
    public function user(): BelongsTo
    {
        return $this->belongsTo(XModel::class, 'user_id');
    }

    #[ManyToMany(related: XModel::class, table: 'model_categories', foreignKey: 'parent_id', localKey: 'id', targetForeignKey: 'model_id', targetLocalKey: 'id')]
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(XModel::class);
    }
}