@extends('layouts.master')

@section('title', 'Tambah Data Cast')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <form action="{{ route('cast.store') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="nama">Nama Cast</label>
            <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Cast">
            @error('nama')
              <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="umur">Umur</label>
            <input name="umur" type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" placeholder="Umur">
            @error('umur')
              <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" id="bio" placeholder="Bio"></textarea>
            @error('bio')
              <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="px-3 d-flex justify-content-between align-items-center">
          <button type="reset" class="btn btn-warning">Reset</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection