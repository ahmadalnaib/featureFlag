<?php
// src/Http/Controllers/FeatureFlagController.php
<?php

namespace YourName\FeatureFlags\Http\Controllers;

use Illuminate\Http\Request;
use YourName\FeatureFlags\Models\FeatureFlag;

class FeatureFlagController extends Controller 
{
    public function index()
    {
        return FeatureFlag::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:feature_flags',
            'enabled' => 'boolean',
            'description' => 'nullable|string'
        ]);

        return FeatureFlag::create($validated);
    }

    public function update(Request $request, $id)
    {
        $feature = FeatureFlag::findOrFail($id);
        
        $validated = $request->validate([
            'enabled' => 'boolean',
            'description' => 'nullable|string'
        ]);
        
        $feature->update($validated);
        return $feature;
    }
}