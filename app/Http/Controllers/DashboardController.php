<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();
        $ledgerEntries = $user->creditLedgerEntries()->latest('created_at')->limit(10)->get();

        return view('dashboard', [
            'user' => $user,
            'creditBalance' => $user->creditBalance(),
            'ledgerEntries' => $ledgerEntries,
        ]);
    }
}
