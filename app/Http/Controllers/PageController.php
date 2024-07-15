<?php

namespace App\Http\Controllers;

use App\Models\Default\File;
use App\Models\Default\Setting;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        return inertia('Page/Index', ['content' => Setting::getByKey('page_registration_requirements')]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Setting::where('key', 'page_registration_requirements')
            ->update(['value' => $request->content]);

        return redirect()->route('pages.index')
            ->with('message', ['type' => 'success', 'message' => 'Item has beed updated']);
    }

    public function persyaratan()
    {
        return inertia('Persyaratan', [
            'content' => Setting::getByKey('page_registration_requirements'),
            'files' => File::where('dir', 'upload')->orderBy('created_at', 'desc')->limit(5)->get(),
            'logo_pengumuman' => asset('files/pengumuman.jpeg')
        ]);
    }
}
