import React, { useEffect, useState } from 'react'
import { Head, useForm } from '@inertiajs/react'
import { isEmpty } from 'lodash'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import TextInput from '@/Components/DaisyUI/TextInput'
import Button from '@/Components/DaisyUI/Button'
import Card from '@/Components/DaisyUI/Card'
import { Option, Select } from '@/Components/DaisyUI/SelectInput'
import FormInputDate from '@/Components/DaisyUI/FormInputDate'
import { useModalState } from '@/hooks'
import MapModal from '@/Components/Common/MapModal'
import Spinner from '@/Components/DaisyUI/Spinner'
import { showToast } from '@/utils'
import axios from 'axios'

export default function Form(props) {
    const { registrant, auth } = props

    const [distance, setDistance] = useState('0 KM')
    const [loading, setLoading] = useState(false)

    const mapModalState = useModalState()
    const { data, setData, post, put, processing, errors } = useForm({
        name: '',
        gender: '',
        nik: '',
        nisn: '',
        place_of_birth: '',
        date_of_birth: '',
        mother_name: '',
        father_name: '',
        junior_sch: '',
        junior_sch_year: '',
        address: '',
        village: '',
        subdistrict: '',
        regency: '',
        phone: '',
        coordinate: '',
        number_kis_pkh: '',
        distance: '',
        description: '',
    })

    const handleSetPosition = (position) => {
        setData('coordinate', `${position[0]}|${position[1]}`)
        setLoading(true)
        axios
            .post(
                route('api.distance'),
                {
                    lat: position[0],
                    lng: position[1],
                },
                {
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        Authorization: auth.jwt_prefix + auth.jwt_token,
                    },
                }
            )
            .then(({ data }) => {
                setDistance(`${data.distance} KM`)
            })
            .finally(() => {
                setLoading(false)
            })
    }

    const handletGetLongLat = () => {
        setLoading(true)
        let q = `${data.address}`
        let q_alt = `${data.village}, ${data.subdistrict}, ${data.regency}}`

        axios
            .get(route('api.geocoding', { q, q_alt }), {
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    Authorization: auth.jwt_prefix + auth.jwt_token,
                },
            })
            .then(({ data }) => {
                if ('latitude' in data) {
                    handleSetPosition([data.latitude, data.longitude])
                } else {
                    showToast('lokasi tidak ditemukan, set dari map', 'error')
                }
            })
            .finally(() => {
                setLoading(false)
            })
    }

    const handleOnChange = (event) => {
        setData(
            event.target.name,
            event.target.type === 'checkbox'
                ? event.target.checked
                    ? 1
                    : 0
                : event.target.value
        )
    }

    const handleSubmit = () => {
        if (isEmpty(registrant) === false) {
            put(route('registrants.update', registrant))
            return
        }
        post(route('registrants.store'))
    }

    useEffect(() => {
        if (!isEmpty(registrant)) {
            setData({
                name: registrant.name,
                gender: registrant.gender,
                nik: registrant.nik,
                nisn: registrant.nisn,
                place_of_birth: registrant.place_of_birth,
                date_of_birth: registrant.date_of_birth,
                mother_name: registrant.mother_name,
                father_name: registrant.father_name,
                junior_sch: registrant.junior_sch,
                junior_sch_year: registrant.junior_sch_year,
                address: registrant.address,
                village: registrant.village,
                subdistrict: registrant.subdistrict,
                regency: registrant.regency,
                phone: registrant.phone,
                coordinate: registrant.coordinate,
                number_kis_pkh: registrant.number_kis_pkh,
                description: registrant.description,
            })
            setDistance(`${registrant.distance} KM`)
        }
    }, [registrant])

    return (
        <AuthenticatedLayout page={'Pendaftaran'}>
            <Head title="Pendaftaran" />

            <div>
                <Card>
                    <div className="flex flex-col gap-2 justify-between">
                        <TextInput
                            name="name"
                            value={data.name}
                            onChange={handleOnChange}
                            label="Nama Lengkap"
                            error={errors.name}
                        />
                        <Select
                            label="Jenis Kelamin"
                            value={data.gender}
                            onChange={handleOnChange}
                            name="gender"
                        >
                            {['', 'laki-laki', 'perempuan'].map((g) => (
                                <Option value={g} key={g}>
                                    {g}
                                </Option>
                            ))}
                        </Select>
                        <TextInput
                            name="nik"
                            value={data.nik}
                            onChange={handleOnChange}
                            label="NIK"
                            error={errors.nik}
                        />
                        <TextInput
                            name="nisn"
                            value={data.nisn}
                            onChange={handleOnChange}
                            label="NISN"
                            error={errors.nisn}
                        />
                        <TextInput
                            name="place_of_birth"
                            value={data.place_of_birth}
                            onChange={handleOnChange}
                            label="Tempat Lahir"
                            error={errors.place_of_birth}
                        />
                        <FormInputDate
                            name="date_of_birth"
                            value={data.date_of_birth}
                            onChange={(date) =>
                                setData('date_of_birth', date.startDate)
                            }
                            label="Tanggal Lahir"
                            error={errors.date_of_birth}
                        />
                        <TextInput
                            name="mother_name"
                            value={data.mother_name}
                            onChange={handleOnChange}
                            label="Nama Ibu Kandung"
                            error={errors.mother_name}
                        />
                        <TextInput
                            name="father_name"
                            value={data.father_name}
                            onChange={handleOnChange}
                            label="Nama Ayah Kandung"
                            error={errors.father_name}
                        />
                        <TextInput
                            name="junior_sch"
                            value={data.junior_sch}
                            onChange={handleOnChange}
                            label="Asal Sekolah"
                            error={errors.junior_sch}
                        />
                        <TextInput
                            name="junior_sch_year"
                            value={data.junior_sch_year}
                            onChange={handleOnChange}
                            label="Tahun Lulus SD/MI"
                            error={errors.junior_sch_year}
                        />
                        <TextInput
                            name="address"
                            value={data.address}
                            onChange={handleOnChange}
                            label="Alamat"
                            error={errors.address}
                        />
                        <TextInput
                            name="village"
                            value={data.village}
                            onChange={handleOnChange}
                            label="Desa"
                            error={errors.village}
                        />
                        <TextInput
                            name="subdistrict"
                            value={data.subdistrict}
                            onChange={handleOnChange}
                            label="Kecamatan"
                            error={errors.subdistrict}
                        />
                        <TextInput
                            name="regency"
                            value={data.regency}
                            onChange={handleOnChange}
                            label="Kabupaten"
                            error={errors.regency}
                        />
                        {loading ? (
                            <Spinner />
                        ) : (
                            <>
                                <div className="flex flex-row gap-4">
                                    <button
                                        className="underline"
                                        onClick={handletGetLongLat}
                                    >
                                        ambil lokasi rumah dari alamat
                                    </button>
                                    <div>|</div>
                                    <button
                                        className="underline"
                                        onClick={mapModalState.toggle}
                                    >
                                        set lokasi rumah dari map
                                    </button>
                                </div>
                                {data.coordinate && (
                                    <div>Jarak ke Sekolah : {distance}</div>
                                )}
                            </>
                        )}
                        <TextInput
                            name="phone"
                            value={data.phone}
                            onChange={handleOnChange}
                            label="No. HP"
                            error={errors.phone}
                        />
                        <TextInput
                            name="number_kis_pkh"
                            value={data.number_kis_pkh}
                            onChange={handleOnChange}
                            label="No KIS/PKH DII"
                            error={errors.number_kis_pkh}
                        />
                        <div className="flex items-center">
                            <div className="flex space-x-2">
                                <Button
                                    onClick={handleSubmit}
                                    processing={processing}
                                    type="primary"
                                >
                                    Simpan
                                </Button>
                            </div>
                        </div>
                    </div>
                </Card>
            </div>
            <MapModal
                modalState={mapModalState}
                handleOk={handleSetPosition}
                _position={data.coordinate ? data.coordinate.split('|') : null}
            />
        </AuthenticatedLayout>
    )
}
