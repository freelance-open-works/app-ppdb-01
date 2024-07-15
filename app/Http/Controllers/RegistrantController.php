<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrantController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Registrant::query();

        if ($request->q != '') {
            $query->where('name', 'like', "%{$request->q}%");
        }

        if ($request->pass != '') {
            $query->where('status', REgistrant::STATUS_PASS);
        }

        $query->orderBy('created_at', 'desc');

        return inertia('Registrant/Index', [
            'data' => $query->paginate(10),
        ]);
    }

    public function create(): Response
    {
        return inertia('Registrant/Form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'nik' => 'nullable|string',
            'nisn' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'mother_name' => 'nullable|string',
            'father_name' => 'nullable|string',
            'junior_sch' => 'nullable|string',
            'junior_sch_year' => 'nullable|string',
            'address' => 'nullable|string',
            'village' => 'nullable|string',
            'subdistrict' => 'nullable|string',
            'regency' => 'nullable|string',
            'phone' => 'nullable|string',
            'coordinate' => 'nullable|string',
            'number_kis_pkh' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Registrant::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'mother_name' => $request->mother_name,
            'father_name' => $request->father_name,
            'junior_sch' => $request->junior_sch,
            'junior_sch_year' => $request->junior_sch_year,
            'address' => $request->address,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'regency' => $request->regency,
            'phone' => $request->phone,
            'coordinate' => $request->coordinate,
            'number_kis_pkh' => $request->number_kis_pkh,
            'description' => $request->description,
        ]);

        return redirect()->route('registrants.index')
            ->with('message', ['type' => 'success', 'message' => 'Item has beed saved']);
    }

    public function edit(Registrant $registrant): Response
    {
        return inertia('Registrant/Form', [
            'registrant' => $registrant,

        ]);
    }

    public function update(Request $request, Registrant $registrant): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'nik' => 'nullable|string',
            'nisn' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'mother_name' => 'nullable|string',
            'father_name' => 'nullable|string',
            'junior_sch' => 'nullable|string',
            'junior_sch_year' => 'nullable|string',
            'address' => 'nullable|string',
            'village' => 'nullable|string',
            'subdistrict' => 'nullable|string',
            'regency' => 'nullable|string',
            'phone' => 'nullable|string',
            'coordinate' => 'nullable|string',
            'number_kis_pkh' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $registrant->fill([
            'name' => $request->name,
            'gender' => $request->gender,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'mother_name' => $request->mother_name,
            'father_name' => $request->father_name,
            'junior_sch' => $request->junior_sch,
            'junior_sch_year' => $request->junior_sch_year,
            'address' => $request->address,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'regency' => $request->regency,
            'phone' => $request->phone,
            'coordinate' => $request->coordinate,
            'number_kis_pkh' => $request->number_kis_pkh,
            'description' => $request->description,
        ]);

        $registrant->save();

        return redirect()->route('registrants.index')
            ->with('message', ['type' => 'success', 'message' => 'Item has beed updated']);
    }

    public function destroy(Registrant $registrant): RedirectResponse
    {
        $registrant->delete();

        return redirect()->route('registrants.index')
            ->with('message', ['type' => 'success', 'message' => 'Item has beed deleted']);
    }

    public function export(Request $request)
    {
        $query = Registrant::query();

        if ($request->q != '') {
            $query->where('name', 'like', "%{$request->q}%");
        }

        if ($request->pass != '') {
            $query->where('status', REgistrant::STATUS_PASS);
        }

        $query->orderBy('created_at', 'desc');

        $name = "pendaftar-" . now()->format('d-m-Y') . ".pdf";

        $pdf = Pdf::loadView('export.registrant', ['items' => $query->get()]);

        return $pdf->setPaper('a3', 'landscape')->download($name);
    }
}
