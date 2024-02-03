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
    work: 'string:255->nullable|default:work',
)]
class YModel extends Model
{

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

}