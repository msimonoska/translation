<?php

namespace Msimonoska\Translation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    // Disable Laravel's mass assignment protection
    protected $guarded = [];
}
