<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table style="width: 100%;" border="1">
        <thead>
            <tr>
                <td style="text-align: center;">Nama</td>
                <td style="text-align: center;">Jenis Kelamin</td>
                <td style="text-align: center;">NIK</td>
                <td style="text-align: center;">NISN</td>
                <td style="text-align: center;">Tempat, Tanggal Lahir</td>
                <td style="text-align: center;">Nama Ibu</td>
                <td style="text-align: center;">Nama Ayah</td>
                <td style="text-align: center;">Asal Sekolah</td>
                <td style="text-align: center;">Tahun Lulus</td>
                <td style="text-align: center;">Alamat</td>
                <td style="text-align: center;">Desa</td>
                <td style="text-align: center;">Kecamatan</td>
                <td style="text-align: center;">Kabupaten</td>
                <td style="text-align: center;">No. HP</td>
                <td style="text-align: center;">No KIS/PKH DII</td>
                <td style="text-align: center;">Jarak Ke Sekolah</td>
                <td style="text-align: center;">Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ $item->place_of_birth }}, {{ $item->date_of_birth }}</td>
                <td>{{ $item->mother_name }}</td>
                <td>{{ $item->father_name }}</td>
                <td>{{ $item->junior_sch }}</td>
                <td>{{ $item->junior_sch_year }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->village }}</td>
                <td>{{ $item->subdistrict }}</td>
                <td>{{ $item->regency }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->number_kis_pkh }}</td>
                <td>{{ $item->distance }} KM</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
<script>
    window.print()
    window.onfocus = function() {
        window.close();
    }
</script>

</html>