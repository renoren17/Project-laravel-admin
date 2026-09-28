@extends('layouts.master')

@section('title', 'Admin Codes')

@push('css')
<style>
    .admin-codes-page .owner-hero {
        background: linear-gradient(120deg, #202124 0%, #34302b 65%, #8b4f2f 100%);
        border-radius: 8px;
        color: #fff;
        overflow: hidden;
        position: relative;
    }

    .admin-codes-page .owner-hero::after {
        color: rgba(244, 185, 66, .2);
        content: '\f084';
        font-family: 'Font Awesome 5 Free';
        font-size: 8rem;
        font-weight: 900;
        position: absolute;
        right: 2rem;
        top: .5rem;
    }

    .admin-codes-page .owner-hero > * { position: relative; z-index: 1; }
    .admin-codes-page .eyebrow { color: #f4b942; font-size: .72rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
    .admin-codes-page .stat-card { border: 0; border-left: 4px solid #f4b942; box-shadow: 0 2px 8px rgba(32, 33, 36, .08); }
    .admin-codes-page .stat-card i { color: #f4b942; font-size: 1.7rem; }
    .admin-codes-page .section-card { border: 0; box-shadow: 0 2px 8px rgba(32, 33, 36, .08); }
    .admin-codes-page .code-value { color: #725313; font-family: monospace; font-size: .95rem; font-weight: 700; letter-spacing: .08em; }
    .admin-codes-page .copy-code { border: 0; color: #6c757d; }
    .admin-codes-page .copy-code:hover { color: #17a2b8; }
    .admin-codes-page .empty-state { color: #6c757d; padding: 2.5rem 1rem; text-align: center; }
</style>
@endpush

@section('content')
<div class="admin-codes-page">
    <div class="owner-hero p-4 mb-4">
        <p class="eyebrow mb-2">Owner Area</p>
        <h2 class="mb-2">Kelola akses Admin</h2>
        <p class="mb-0 text-white-50">Buat kode undangan sekali pakai untuk memberikan akses administrator.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            <i class="fas fa-check-circle mr-1"></i>{{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total kode</p>
                        <h3 class="mb-0">{{ $codes->count() }}</h3>
                    </div>
                    <i class="fas fa-key"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card stat-card h-100" style="border-left-color: #4f8a8b;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Belum digunakan</p>
                        <h3 class="mb-0">{{ $codes->whereNull('user_id')->count() }}</h3>
                    </div>
                    <i class="fas fa-clock" style="color: #4f8a8b;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card stat-card h-100" style="border-left-color: #6f8f47;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Sudah digunakan</p>
                        <h3 class="mb-0">{{ $codes->whereNotNull('user_id')->count() }}</h3>
                    </div>
                    <i class="fas fa-user-check" style="color: #6f8f47;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card section-card mb-4">
        <div class="card-header bg-white border-0 pt-3">
            <h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle text-warning mr-2"></i>Buat kode baru</h3>
        </div>
        <div class="card-body pt-1">
            <form method="POST" action="{{ route('owner.admin-codes.store') }}">
                @csrf
                <div class="form-row align-items-end">
                    <div class="form-group col-md-5 mb-md-0">
                        <label for="nama">Nama calon Admin</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 mb-md-0">
                        <label for="no_id">No Induk Siswa</label>
                        <input type="text" id="no_id" name="no_id" class="form-control" value="{{ old('no_id') }}" required>
                        @error('no_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-0">
                        <button type="submit" class="btn btn-warning btn-block font-weight-bold">
                            <i class="fas fa-key mr-1"></i> Generate Kode
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card section-card">
        <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold mb-0"><i class="fas fa-list text-muted mr-2"></i>Daftar kode admin</h3>
            <span class="badge badge-light">{{ $codes->count() }} kode</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th class="pl-4">Nama</th>
                            <th>No Induk Siswa</th>
                            <th>Kode</th>
                            <th>Status</th>
                            <th>Digunakan oleh</th>
                            <th class="text-right pr-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($codes as $code)
                            <tr>
                                <td class="pl-4 font-weight-bold">{{ $code->nama }}</td>
                                <td>{{ $code->no_id ?: '-' }}</td>
                                <td><span class="code-value">{{ $code->kode }}</span></td>
                                <td>
                                    @if ($code->user_id)
                                        <span class="badge badge-success"><i class="fas fa-check mr-1"></i>Sudah digunakan</span>
                                    @else
                                        <span class="badge badge-warning"><i class="fas fa-clock mr-1"></i>Belum digunakan</span>
                                    @endif
                                </td>
                                <td>{{ $code->user ? $code->user->name : '-' }}</td>
                                <td class="text-right pr-4">
                                    <button type="button" class="btn btn-sm btn-light copy-code" data-code="{{ $code->kode }}" title="Salin kode">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fas fa-key fa-2x mb-2 text-muted"></i>
                                    <p class="mb-0">Belum ada kode admin. Buat kode pertama untuk calon Admin.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.querySelectorAll('.copy-code').forEach(function (button) {
        button.addEventListener('click', function () {
            navigator.clipboard.writeText(button.dataset.code);
            button.innerHTML = '<i class="fas fa-check text-success"></i>';
            setTimeout(function () {
                button.innerHTML = '<i class="far fa-copy"></i>';
            }, 1400);
        });
    });
</script>
@endpush
