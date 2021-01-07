@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Surat Masuk</h5>
                    <a href="{{ url('masuk/create') }}" class="btn btn-primary btn-sm">Tambah</a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-inverse">
                        <thead>
                            <tr>
                                <th>Opsi</th>
                                <th>tgl surat</th>
                                <th>tgl diterima</th>
                                <th>perihal</th>
                                <th>sifat</th>
                                <th>asal surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_all as $data)
                                <tr>
                                    <td>
                                        <a href="{{ url('masuk/'.$data->id.'/edit') }}">edit</a>
                                        <a href="{{ url('masuk/destroy/'.$data->id) }}">hapus</a>
                                    </td>
                                    <td>{{ $data->tgl_surat  }}</td>
                                    <td>{{ $data->tgl_diterima  }}</td>
                                    <td>{{ $data->perihal  }}</td>
                                    <td>{{ $data->sifat_text()  }}</td>
                                    <td>{{ $data->asal_surat  }}</td>
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
