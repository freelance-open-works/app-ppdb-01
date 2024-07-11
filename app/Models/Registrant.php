<?php

namespace App\Models;

use App\Models\Default\Model;

class Registrant extends Model
{
    const STATUS_PASS = 'Lulus';
    const STATUS_FAIL = 'Tidak Lulus';

    protected $fillable = [
        'name',
        'gender',
        'nik',
        'nisn',
        'place_of_birth',
        'date_of_birth',
        'mother_name',
        'father_name',
        'junior_sch',
        'junior_sch_year',
        'address',
        'village',
        'subdistrict',
        'regency',
        'phone',
        'number_kis_pkh',
        'description',
    ];
}
