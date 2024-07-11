<?php

namespace App\Models;

use App\Models\Default\Model;
use App\Models\Default\Setting;

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
        'coordinate',
        'number_kis_pkh',
        'description',
        'distance',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (Registrant $r) {
            $setting = explode('|', Setting::getByKey('school_coordinate'));
            $coordinate = explode('|', $r->coordinate);

            $r->distance = number_format(calculateDistance($setting[0], $setting[1], $coordinate[0], $coordinate[1]), 2);

            $r->status = self::STATUS_FAIL;
            if ($r->distance <= Setting::getByKey('school_max_distance')) {
                $r->status = self::STATUS_PASS;
            }
        });

        static::updating(function (Registrant $r) {
            $setting = explode('|', Setting::getByKey('school_coordinate'));
            $coordinate = explode('|', $r->coordinate);

            $r->distance = number_format(calculateDistance($setting[0], $setting[1], $coordinate[0], $coordinate[1]), 2);

            $r->status = self::STATUS_FAIL;
            if ($r->distance <= Setting::getByKey('school_max_distance')) {
                $r->status = self::STATUS_PASS;
            }
        });
    }
}
