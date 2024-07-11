import React from 'react'
import { Head, useForm } from '@inertiajs/react'
import { isEmpty } from 'lodash'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import Card from '@/Components/DaisyUI/Card'
import TextInput from '@/Components/DaisyUI/TextInput'
import Button from '@/Components/DaisyUI/Button'
import FormFile from '@/Components/DaisyUI/FormFile'
import { useModalState } from '@/hooks'
import MapModal from '@/Components/Common/MapModal'

const extractValue = (set, key) => {
    const find = set.find((s) => s.key === key)
    if (isEmpty(find) === false) {
        if (find.type === 'image') {
            return find?.url
        }
        return find?.value
    }
    return ''
}

export default function Setting(props) {
    const { setting } = props

    const app_logo_url = extractValue(setting, 'app_logo')
    const { data, setData, post, processing, errors } = useForm({
        app_name: extractValue(setting, 'app_name'),
        app_logo: '',
        school_address: extractValue(setting, 'school_address'),
        school_coordinate: extractValue(setting, 'school_coordinate'),
        school_max_distance: extractValue(setting, 'school_max_distance'),
    })

    const mapModalState = useModalState()

    const handleSetCoordinate = (position) => {
        setData('school_coordinate', `${position[0]}|${position[1]}`)
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
        post(route('setting.update'))
    }

    return (
        <AuthenticatedLayout page={'System'} action={'Setting'}>
            <Head title="Setting" />

            <div>
                <Card>
                    <div className="text-xl font-bold mb-4 text-base-content">
                        Setting
                    </div>
                    <TextInput
                        name="app_name"
                        value={data.app_name}
                        onChange={handleOnChange}
                        label="Nama"
                        error={errors.app_name}
                    />
                    <TextInput
                        name="school_address"
                        value={data.school_address}
                        onChange={handleOnChange}
                        label="Alamat"
                        error={errors.school_address}
                    />
                    <div className="underline" onClick={mapModalState.toggle}>
                        pilih koordinat
                    </div>
                    <TextInput
                        name="school_max_distance"
                        value={data.school_max_distance}
                        onChange={handleOnChange}
                        label="Jarak Maksimal (KM)"
                        error={errors.school_max_distance}
                    />
                    <FormFile
                        label={'Logo'}
                        onChange={(file_path) => setData('app_logo', file_path)}
                        error={errors.app_logo}
                        url={app_logo_url}
                        filemimes="image/jpg,image/jpeg,image/png"
                    />
                    <div className="mt-4">
                        <Button
                            onClick={handleSubmit}
                            processing={processing}
                            type="primary"
                        >
                            Simpan
                        </Button>
                    </div>
                </Card>
            </div>
            <MapModal
                modalState={mapModalState}
                handleOk={handleSetCoordinate}
                _position={data.school_coordinate.split('|')}
            />
        </AuthenticatedLayout>
    )
}
