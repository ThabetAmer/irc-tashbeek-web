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
                ->where('user_id', auth()->id())
                ->with('entity')
                ->paginate(30)
        );
    }
}
