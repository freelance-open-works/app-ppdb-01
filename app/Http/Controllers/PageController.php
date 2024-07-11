<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        return inertia('Page/Index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return redirect()->route('pages.index')
            ->with('message', ['type' => 'success', 'message' => 'Item has beed updated']);
    }
}
