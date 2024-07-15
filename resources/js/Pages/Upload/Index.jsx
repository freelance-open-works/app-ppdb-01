import React from 'react'
import { router } from '@inertiajs/react'
import { Head } from '@inertiajs/react'
import { HiDownload, HiTrash } from 'react-icons/hi'
import { useModalState } from '@/hooks'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import Pagination from '@/Components/DaisyUI/Pagination'
import ModalConfirm from '@/Components/DaisyUI/ModalConfirm'
import Button from '@/Components/DaisyUI/Button'
import Card from '@/Components/DaisyUI/Card'
import FormFile from '@/Components/DaisyUI/FormFile'
import { formatDateTime } from '@/utils'

export default function Index(props) {
    const {
        data: { links, data },
    } = props

    const confirmModal = useModalState()

    const handleDeleteClick = (file) => {
        confirmModal.setData(file)
        confirmModal.toggle()
    }

    const onDelete = () => {
        if (confirmModal.data !== null) {
            router.delete(route('upload-daftar-diterima.destroy', confirmModal.data.id))
        }
    }

    return (
        <AuthenticatedLayout page={'System'} action={'Upload'}>
            <Head title="Upload" />

            <div className='flex flex-col gap-2'>
                <Card>
                    <FormFile dir='upload' callback={() => router.get(route(route().current()))}/>
                </Card>
                <Card>
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
                                {data.map((file, index) => (
                                    <tr key={file.id}>
                                        <td>{file.name}</td>
                                        <td>{formatDateTime(file.created_at)}</td>
                                        <td className="text-right">
                                            <div className='w-full flex gap-2 justify-end'>
                                                <a href={route('file.show', file.hash_name)} download={file.name}>
                                            <Button>
                                                <HiDownload className='w-5 h-5'/>
                                            </Button>
                                                </a>
                                                <Button onClick={() => handleDeleteClick(file)}>
                                                    <HiTrash className='w-5 h-5'/>
                                                </Button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    <div className="w-full overflow-x-auto flex lg:justify-center">
                        <Pagination links={links} />
                    </div>
                </Card>
            </div>
            <ModalConfirm modalState={confirmModal} onConfirm={onDelete} />
        </AuthenticatedLayout>
    )
}
