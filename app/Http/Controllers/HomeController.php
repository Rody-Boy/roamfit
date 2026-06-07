<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredFacilities = Facility::query()
            ->where('status', 'active')
            ->latest()
            ->limit(6)
            ->get();

        return view('home', compact('featuredFacilities'));
    }
}
