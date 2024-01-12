<?php

namespace Aldeebhasan\Emigrate\Test\Unit\Models;

use Aldeebhasan\Emigrate\Attributes\Migratable;
use Aldeebhasan\Emigrate\Attributes\Relations\{ManyToMany, ManyToOne, OneToMany, OneToOne};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Migratable(
    id: 'primary|bigint|index',
    name: 'string|bigint',
    user_id: 'int|index',
    parent_id: 'int|index'
)]
class XModel extends Model
{

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    #[OneToMany(related: XModel::class, fk: 'parent_id')]
    public function children(): HasMany
    {
        return $this->hasMany(XModel::class, 'parent_id');
    }

    #[OneToOne(related: XModel::class, fk: 'parent_id')]
    public function hol(): HasOne
    {
        return $this->hasOne(XModel::class, 'parent_id');
    }

    #[ManyToOne(related: XModel::class, fk: 'parent_id')]
    public function parent(): BelongsTo
    {
        return $this->belongsTo(XModel::class, 'parent_id');
    }

    #[ManyToMany(related: Model::class, fk: 'parent_id')]
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Model::class);
    }
}