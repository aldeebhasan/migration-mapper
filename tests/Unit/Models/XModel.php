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
    id: 'id->index|nullable',
    name: 'string:199->nullable|default:name theres',
    work: 'string:255->nullable|default:work theres',
    salary: 'decimal:10,2->nullable|default:5',
    description: 'text->nullable|default:description',
    user_id: 'integer->nullable',
    updated_at: 'timestamp->current',
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

    #[OneToOne(related: XModel::class, foreignKey: 'parent_id', localKey: 'id')]
    public function hol(): HasOne
    {
        return $this->hasOne(XModel::class, 'parent_id');
    }

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

    #[ManyToMany(related: Model::class, table: 'model_categories', foreignKey: 'parent_id', localKey: 'id')]
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Model::class);
    }
}