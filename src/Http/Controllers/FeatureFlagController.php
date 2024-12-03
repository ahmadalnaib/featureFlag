<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FeatureFlag;
use Illuminate\Http\Request;

class FeatureFlagController extends Controller
{
    //


    public function store(Request $request)
    {
        FeatureFlag::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $feature = FeatureFlag::findOrFail($id);
        $feature->update($request->all());
        return redirect()->back();
    }
}
