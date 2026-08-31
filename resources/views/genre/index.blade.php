@extends('layouts.master')

@section('title', 'Data Genre')

@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('genre.create') }}" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-plus"></i> Genre
        </a>
    </div>

    <div class="card-body">

        <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($genres as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection