<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\FeatureFlag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureFlagController extends Controller
{
    //
    public function index()
    {
        $features = FeatureFlag::all();
        return response()->json($features);
    }
}
