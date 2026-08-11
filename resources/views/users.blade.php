@extends('layouts.master')

@section('title', 'Data Pengguna')

@section('content')

{{-- ================= INFO CARD ================= --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalAdmin ?? 3 }}</h3>
                <p>Total Admin</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalGuru ?? 25 }}</h3>
                <p>Total Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalStaff ?? 8 }}</h3>
                <p>Total Staff TU</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalNonaktif ?? 2 }}</h3>
                <p>Nonaktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-slash"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /.row -->

{{-- ================= TABLE CARD ================= --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center g-2">
                    <div class="col-12 col-md-4">
                        <h3 class="card-title"><i class="fas fa-users"></i> Daftar Pengguna</h3>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="search" id="user-search" class="form-control" placeholder="Cari pengguna">
                            </div>
                            <select id="user-role-filter" class="form-select form-select-sm" style="width: 160px;">
                                <option value="all" selected>Semua Role</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="staff">Staff TU</option>
                            </select>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-user">
                                <i class="fas fa-user-plus mr-1"></i> Tambah Pengguna
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Muchammad Abdurrohim</td>
                            <td>ohimlutung@sekolah.sch.id</td>
                            <td><span class="badge bg-danger">Admin</span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>12 Mar 2025</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-secondary"><i class="fas fa-pen"></i></button>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete-user"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Muhammad Ilham</td>
                            <td>ilhamilmuhitam@sekolah.sch.id</td>
                            <td><span class="badge bg-info">Guru</span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>3 Apr 2025</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-secondary"><i class="fas fa-pen"></i></button>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete-user"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Abdul Sigit</td>
                            <td>sigitrendang@sekolah.sch.id</td>
                            <td><span class="badge bg-warning">Staff TU</span></td>
                            <td><span class="badge bg-secondary">Nonaktif</span></td>
                            <td>28 Apr 2025</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-secondary"><i class="fas fa-pen"></i></button>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete-user"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <div class="float-left pt-1 small text-muted">Menampilkan 1 sampai 3 dari 3 pengguna</div>
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

{{-- ================= MODAL TAMBAH USER ================= --}}
<div class="modal fade" id="modal-add-user" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna Baru</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="cth. Budi Santoso" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="nama@sekolah.sch.id" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control">
                            <option selected>Guru</option>
                            <option>Staff TU</option>
                            <option>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL HAPUS USER ================= --}}
<div class="modal fade" id="modal-delete-user" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah kamu yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection