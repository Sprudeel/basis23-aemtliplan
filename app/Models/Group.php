<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'aemtli'];

    public function aemtli(): BelongsTo {
        return $this->belongsTo(Aemtli::class, 'aemtli', 'id');
    }

    public function participants(): HasMany {
        return $this->hasMany(Participant::class, 'group', 'id');
    }
}
