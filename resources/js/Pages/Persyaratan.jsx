import React from 'react'
import { Head, Link } from '@inertiajs/react'
import Button from '@/Components/DaisyUI/Button'
import Card from '@/Components/DaisyUI/Card'
import ApplicationLogo from '@/Components/ApplicationLogo'

export default function Persyaratan({ content, files, logo_pengumuman }) {
    return (
        <div>
            <Head title="Log in" />

            <div className="min-h-screen flex flex-col sm:justify-center items-center md:pt-6 bg-base-300 gap-2">
                <div className="flex flex-col justify-center items-center">
                    <Link href="/">
                        <ApplicationLogo className="w-auto mb-2 fill-current text-base-content text-4xl font-bold text-center" />
                    </Link>
                    <img src={logo_pengumuman} className="w-52" />
                </div>
                <div className="w-full h-fit bg-base-100 shadow-xl max-w-md flex flex-col md:rounded-xl">
                    <Card>
                        <div className="flex flex-col">
                            <div className="font-bold text-lg">
                                Persyaratan Pendaftaran :
                            </div>
                            <textarea
                                value={content}
                                readOnly={true}
                                rows={10}
                                className="textarea"
                            />
                        </div>
                    </Card>
                </div>
                <div className="w-full h-fit bg-base-100 shadow-xl max-w-md flex flex-col md:rounded-xl">
                    <Card>
                        <div className="flex flex-col">
                            <div className="font-bold text-lg">
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
                                                <td>
                                                    {formatDateTime(
                                                        file.created_at
                                                    )}
                                                </td>
                                                <td className="text-right">
                                                    <div className="w-full flex gap-2 justify-end">
                                                        <a
                                                            href={route(
                                                                'file.show',
                                                                file.hash_name
                                                            )}
                                                            download={file.name}
                                                        >
                                                            <Button>
                                                                <HiDownload className="w-5 h-5" />
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
                    </Card>
                </div>
            </div>
        </div>
    )
}
