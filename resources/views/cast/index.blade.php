@extends('layouts.master')

@section('title', 'Data Cast')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('cast.create') }}" class="btn btn-sm btn-outline-primary">
          <i class="fa fa-plus"></i> Cast
        </a>
      </div>
      <div class="card-body">
        <table id="table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Umur</th>
              <th>Bio</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($casts as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->umur }}</td>
                <td>{{ $value->bio }}</td>
                <td>
                  <a href="{{ route('cast.edit', $value->id) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('cast.delete', $value->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data ini?')">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">Data Masih Kosong</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection