import React, { useEffect } from 'react'
import GuestLayout from '@/Layouts/GuestLayout'
import { Head, router, useForm } from '@inertiajs/react'
import TextInput from '@/Components/DaisyUI/TextInput'
import Checkbox from '@/Components/DaisyUI/Checkbox'
import Button from '@/Components/DaisyUI/Button'

export default function Persyaratan({ content }) {
    
    return (
        <GuestLayout>
            <Head title="Log in" />

            <div className='flex flex-col'>
                <div className='font-bold text-lg'>
                    Persyaratan Pendaftaran : 
                </div>
                <textarea value={content} readOnly={true} rows={20} className='textarea'/>
                <div className='w-full flex justify-end'>
                    <button className='underline hover:text-blue-500' onClick={() => router.get(route('pages.pengumuman'))}>
                        Pengumuman Penerimaan
                    </button>
                </div>
            </div>
        </GuestLayout>
    )
}
