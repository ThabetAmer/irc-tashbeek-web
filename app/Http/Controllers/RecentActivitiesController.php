<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecentActivityGroupedCollection;
use App\Models\RecentActivity;

class RecentActivitiesController extends Controller
{
    public function index()
    {
        return new RecentActivityGroupedCollection(
            RecentActivity::latest()
                ->with('entity')
                ->paginate(30)
        );
    }
}
