<?php

namespace App\Models\Default;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'label',
    ];
}
