<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Models\Default\Role;
use App\Models\Default\User;
use App\Models\Registrant;
use Illuminate\Contracts\Routing\Registrar;

class GeneralController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'role_count' => Role::count(),
            'user_count' => User::count(),
            'registrant' => Registrant::count(),
            'registrant_pass' => Registrant::where('status', Registrant::STATUS_PASS)->count(),
        ]);
    }

    public function maintance()
    {
        return inertia('Maintance');
    }
}
