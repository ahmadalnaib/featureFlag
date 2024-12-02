<?php
// src/Models/FeatureFlag.php
<?php

namespace YourName\FeatureFlags\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureFlag extends Model
{
    protected $fillable = ['name', 'enabled', 'description'];
    
    protected $casts = [
        'enabled' => 'boolean'
    ];
}