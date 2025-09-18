<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data siswa berdasarkan user login
        $siswa = DB::table('siswas')
            ->where('id_user', $user->id)
            ->first();

        // 1. Total kelas industri yang diikuti siswa
        $totalKelasIndustri = DB::table('kelas_industris')
            ->join('siswas', 'kelas_industris.id', '=', 'siswas.id_kelasindustri')
            ->where('siswas.id', $siswa->id)
            ->count();

        // 2. Total project aktif siswa
        $totalProjectAktif = DB::table('project_member')
            ->join('projects', 'project_member.id_project', '=', 'projects.id')
            ->where('project_member.id_siswa', $siswa->id)
            ->where('projects.status', 'proses')
            ->count();

        // 3. Progress rata-rata semua project siswa
        $progressRataRata = DB::table('project_progress')
            ->join('project_member', 'project_progress.id_project', '=', 'project_member.id_project')
            ->where('project_member.id_siswa', $siswa->id)
            ->avg('project_progress.progress_percent');

        $progressRataRata = round($progressRataRata ?? 0);

        // 4. List project aktif beserta progress
        $projects = DB::table('projects')
            ->join('project_member', 'projects.id', '=', 'project_member.id_project')
            ->leftJoin('project_progress', 'projects.id', '=', 'project_progress.id_project')
            ->select(
                'projects.nama_project',
                'projects.expected_output',
                'projects.deadline',
                DB::raw('COALESCE(MAX(project_progress.progress_percent), 0) as progress')
            )
            ->where('project_member.id_siswa', $siswa->id)
            ->groupBy('projects.id', 'projects.nama_project', 'projects.expected_output', 'projects.deadline')
            ->get();

        // 5. Jadwal produksi hari ini
        $jadwalHariIni = DB::table('jadwal_produksi')
            ->join('projects', 'jadwal_produksi.id_project', '=', 'projects.id')
            ->whereDate('jadwal_produksi.tanggal_mulai', Carbon::today())
            ->where('jadwal_produksi.id_kelasindustri', $siswa->id_kelasindustri)
            ->select('projects.nama_project', 'jadwal_produksi.jam_mulai', 'jadwal_produksi.jam_selesai')
            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'totalKelasIndustri',
            'totalProjectAktif',
            'progressRataRata',
            'projects',
            'jadwalHariIni'
        ));
    }
}
