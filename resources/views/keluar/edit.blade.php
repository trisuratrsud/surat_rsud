@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('keluar',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
        {{ method_field('PUT') }}
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>data surat keluar</h5>
                    </div>

                    <div class="card-body table-responsive">
                        <div class="form-group">
                            <label for="">tgl surat</label>
                            <input type="date" class="form-control" required name="tgl_surat" value="{{ $data->tgl_surat }}">
                        </div>
                        <div class="form-group">
                            <label for="">Surat Masuk</label>
                            {{ Form::select('id_surat_masuk',  \App\Models\SuratMasuk::list_surat(), $data->id_surat_masuk,['class'=>'form-control js-select', 'required'=>true])}}
                        </div>
                        <div class="form-group">
                            <label for="">perihal</label>
                            <textarea class="form-control" required name="perihal" >{{ $data->perihal }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Sifat</label>
                            {{ Form::select('sifat',  \App\Models\HelperData::sifat_surat(), $data->sifat,['class'=>'form-control js-select', 'required'=>true])}}
                        </div>

                        <div class="form-group">
                            <label for="">tujuan surat</label>
                            <input type="text" class="form-control" required name="tujuan_surat" value="{{ $data->tujuan_surat }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
