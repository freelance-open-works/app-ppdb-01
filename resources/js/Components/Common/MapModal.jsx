import {
    MapContainer,
    TileLayer,
    Marker,
    Popup,
    useMapEvents,
    useMap,
} from 'react-leaflet'

import Modal from '../DaisyUI/Modal'
import SearchInput from '../DaisyUI/SearchInput'
import { useEffect, useMemo, useRef, useState } from 'react'
import { usePage } from '@inertiajs/react'
import axios from 'axios'
import { showToast } from '@/utils'
import Button from '../DaisyUI/Button'
import { isEmpty } from 'lodash'

export default function MapModal(props) {
    const {
        props: { auth },
    } = usePage()
    const { modalState, handleOk, _position } = props

    const [search, setSearch] = useState('')

    const center = [-3.1348614997023714, 114.53607186724686]
    const [processing, setProcessiong] = useState(false)
    const [position, setPosition] = useState(center)

    const handleClickOk = () => {
        modalState.toggle()
        handleOk(position)
    }

    const handleClose = () => {
        modalState.toggle()
    }

    const handleKeyDown = (e) => {
        if (e.code === 'Enter') {
            setProcessiong(true)
            axios
                .get(route('api.geocoding', { q: search }), {
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        Authorization: auth.jwt_prefix + auth.jwt_token,
                    },
                })
                .then(({ data }) => {
                    if ('latitude' in data) {
                        setPosition([data.latitude, data.longitude])
                    } else {
                        showToast('lokasi tidak ditemukan', 'error')
                    }
                })
                .finally(() => {
                    setProcessiong(false)
                })
        }
    }

    useEffect(() => {
        if (!isEmpty(_position)) {
            setPosition(_position)
        }
    }, [_position])

    return (
        <Modal isOpen={modalState.isOpen} onClose={handleClose}>
            <div className="grid grid-cols-1 gap-2 p-1">
                <div>
                    <SearchInput
                        placeholder="Cari Lokasi"
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                        onKeyDownCapture={handleKeyDown}
                    />
                </div>
                <div className="map">
                    <MapContainer
                        center={center}
                        zoom={10}
                        scrollWheelZoom={true}
                    >
                        <DraggableMarker
                            position={position}
                            setPosition={setPosition}
                        />
                        <TileLayer
                            attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                        />
                    </MapContainer>
                </div>
                <Button onClick={handleClickOk} processing={processing}>
                    Ok
                </Button>
            </div>
        </Modal>
    )
}

function DraggableMarker({ position, setPosition }) {
    const markerRef = useRef(null)
    const map = useMap()
    const eventHandlers = useMemo(
        () => ({
            dragend() {
                const marker = markerRef.current
                if (marker != null) {
                    setPosition([
                        marker.getLatLng().lat,
                        marker.getLatLng().lng,
                    ])
                }
            },
        }),
        []
    )

    useEffect(() => {
        map.flyTo(position, map.getZoom())
    }, [position])

    return (
        <Marker
            draggable={true}
            eventHandlers={eventHandlers}
            position={position}
            ref={markerRef}
        >
            <Popup minWidth={90}></Popup>
        </Marker>
    )
}
