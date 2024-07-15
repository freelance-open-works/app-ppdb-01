<?php

namespace App\Http\Controllers;

use App\Models\Default\File;
use Illuminate\Http\Request;

class UploadRegistrantController extends Controller
{
    public function index(Request $request) {
        $files = File::where('dir', 'upload');

        return inertia('Upload/Index', [
            'data' => $files->paginate(),
        ]);
    }

    public function destroy(string $id) {
        $file = File::find($id);

        $file->delete();

        return redirect()->route('upload-daftar-diterima')
        ->with('message', ['type' => 'success', 'message' => 'Item has beed deleted']);
    }
}
