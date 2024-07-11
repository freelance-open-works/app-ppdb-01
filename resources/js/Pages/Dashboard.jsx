import React from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { Head } from '@inertiajs/react'
import Card from '@/Components/DaisyUI/Card'
import DummyDashbord from '@/Components/Dummy/Dashboard'

export default function Dashboard(props) {
    return (
        <AuthenticatedLayout page={'Dashboard'} action={''}>
            <Head title="Dashboard" />

            <div>
                <div className="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 py-2 gap-2">
                    <div className="stats shadow flex-1">
                        <div className="stat">
                            <div className="stat-title">Roles</div>
                            <div className="stat-value text-primary">
                                {props.role_count}{' '}
                            </div>
                        </div>
                    </div>
                    <div className="stats shadow flex-1">
                        <div className="stat">
                            <div className="stat-title">Users</div>
                            <div className="stat-value text-primary">
                                {props.user_count}
                            </div>
                        </div>
                    </div>
                    <div className="stats shadow flex-1">
                        <div className="stat">
                            <div className="stat-title">Pendaftar</div>
                            <div className="stat-value text-primary">
                                {props.registrant}
                            </div>
                        </div>
                    </div>
                    <div className="stats shadow flex-1">
                        <div className="stat">
                            <div className="stat-title">Diterima</div>
                            <div className="stat-value text-primary">
                                {props.registrant_pass}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}
