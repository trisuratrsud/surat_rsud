@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Surat keluar</h5>
                    <a href="{{ url('keluar/create') }}" class="btn btn-primary btn-sm">Tambah</a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-inverse">
                        <thead>
                            <tr>
                                <th>Opsi</th>
                                <th>tgl surat</th>
                                <th>surat Masuk</th>
                                <th>perihal</th>
                                <th>sifat</th>
                                <th>tujuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_all as $data)
                                <tr>
                                    <td>
                                        <a href="{{ url('keluar/'.$data->id.'/edit') }}">edit</a>
                                        <a href="{{ url('keluar/destroy/'.$data->id) }}">hapus</a>
                                    </td>
                                    <td>{{ $data->tgl_surat  }}</td>
                                    <td>{{ @$data->masuk->perihal  }}</td>
                                    <td>{{ $data->perihal  }}</td>
                                    <td>{{ $data->sifat_text()  }}</td>
                                    <td>{{ $data->tujuan  }}</td>
                                </tr>
                            @empty 
                                <tr>
                                    <td colspan="5">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">{{ $data_all->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
