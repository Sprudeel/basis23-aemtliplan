<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Aemtli extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function group(): HasOne {
        return $this->hasOne(Group::class);
    }
}
