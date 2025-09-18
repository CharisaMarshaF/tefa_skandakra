
@section('content')
<div class="container">
    <h2>Selamat Datang di TEFA SMKN 2 KARANGANYAR, {{ $siswa->nama_lengkap }}!</h2>
    <p>Dengan sistem informasi TEFA Membangun Generasi Bangsa Yang Maju.</p>

    <div class="row text-center my-4">
        <div class="col">
            <h4>Kelas Industri</h4>
            <p>{{ $totalKelasIndustri }}</p>
        </div>
        <div class="col">
            <h4>Project Aktif</h4>
            <p>{{ $totalProjectAktif }}</p>
        </div>
        <div class="col">
            <h4>Progress Rata-rata</h4>
            <p>{{ $progressRataRata }}%</p>
        </div>
    </div>

    <h3>Projek Aktif</h3>
    <ul class="list-group mb-4">
        @forelse($projects as $project)
            <li class="list-group-item">
                <strong>{{ $project->nama_project }}</strong> - Progress: {{ $project->progress }}%
            </li>
        @empty
            <li class="list-group-item">Belum ada project aktif.</li>
        @endforelse
    </ul>

    <h3>Jadwal Produksi Hari Ini</h3>
    <ul class="list-group">
        @forelse($jadwalHariIni as $jadwal)
            <li class="list-group-item">
                {{ $jadwal->nama_project }} ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
            </li>
        @empty
            <li class="list-group-item">Tidak ada jadwal produksi hari ini.</li>
        @endforelse
    </ul>
</div>

