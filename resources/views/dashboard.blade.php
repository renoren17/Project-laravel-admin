@extends('layouts.master')

@section('title', 'Dashboard Utama')

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- Box 1: Siswa -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Total Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Box 2: Guru -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>25</h3>
                <p>Total Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Box 3: Mata Pelajaran -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>Mata Pelajaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Box 4: Kelas -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>12</h3>
                <p>Total Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-open"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- Card Sambutan -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> Selamat Datang, Administrator</h5>
            </div>
            <div class="card-body">
                <p>Ini adalah halaman dashboard utama sistem informasi manajemen sekolah. Semua data di atas diambil secara real-time dari database aplikasi.</p>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Tambahan (Contoh Data Siswa Terbaru) -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Siswa Terbaru</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ahmad Fauzi</td>
                            <td>998231</td>
                            <td>X IPA 1</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Siti Aminah</td>
                            <td>998232</td>
                            <td>X IPA 2</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Budi Santoso</td>
                            <td>998233</td>
                            <td>XI IPS 1</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection