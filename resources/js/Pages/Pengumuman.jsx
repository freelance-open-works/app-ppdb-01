import React from 'react'
import GuestLayout from '@/Layouts/GuestLayout'
import { Head } from '@inertiajs/react'
import Button from '@/Components/DaisyUI/Button'
import { formatDateTime } from '@/utils'
import { HiDownload } from 'react-icons/hi'

export default function Persyaratan({ files }) {
    
    return (
        <GuestLayout>
            <Head title="Log in" />

            <div className='flex flex-col'>
                <div className='font-bold text-lg'>
                    Pengumuman Penerimaan : 
                </div>
                <div className="overflow-x-auto">
                    <table className="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th />
                            </tr>
                        </thead>
                        <tbody>
                            {files.map((file, index) => (
                                <tr key={file.id}>
                                    <td>{file.name}</td>
                                    <td>{formatDateTime(file.created_at)}</td>
                                    <td className="text-right">
                                        <div className='w-full flex gap-2 justify-end'>
                                            <a href={route('file.show', file.hash_name)} download={file.name}>
                                                <Button>
                                                    <HiDownload className='w-5 h-5' />
                                                </Button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </GuestLayout>
    )
}
