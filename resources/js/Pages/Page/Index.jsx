import React from 'react'
import { Head, useForm } from '@inertiajs/react'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import Card from '@/Components/DaisyUI/Card'
import TextInput from '@/Components/DaisyUI/TextInput'
import Button from '@/Components/DaisyUI/Button'

export default function Page(props) {
    const { content } = props

    const { data, setData, post, processing, errors } = useForm({
        content: content,
    })

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
        post(route('pages.update'))
    }

    return (
        <AuthenticatedLayout page={'System'} action={'Halaman Persyaratan'}>
            <Head title="Halaman Persyaratan" />

            <div>
                <Card>
                    <div className="text-xl font-bold mb-4 text-base-content">
                        Halaman Persyaratan
                    </div>
                    <textarea 
                        className="textarea textarea-bordered"
                        name="content"
                        value={data.content}
                        rows={8}
                        onChange={handleOnChange}
                    />
                    {errors.content && (
                        <div className='alert alert-error'>
                            {errors.content}
                        </div>
                    )}
                    
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
        </AuthenticatedLayout>
    )
}
