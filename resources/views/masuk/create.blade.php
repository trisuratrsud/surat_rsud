@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('masuk') }}" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Tambah data surat masuk</h5>
                    </div>

                    <div class="card-body table-responsive">
                        <div class="form-group">
                            <label for="">tgl surat</label>
                            <input type="date" class="form-control" required name="tgl_surat" value="{{ old('tgl_surat') }}">
                        </div>
                        <div class="form-group">
                            <label for="">tgl diterima</label>
                            <input type="date" class="form-control" required name="tgl_diterima" value="{{ old('tgl_diterima') }}">
                        </div>
                        <div class="form-group">
                            <label for="">perihal</label>
                            <textarea class="form-control" required name="perihal" >{{ old('perihal') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Sifat</label>
                            {{ Form::select('sifat',  \App\Models\HelperData::sifat_surat(), null,['class'=>'form-control js-select', 'required'=>true])}}
                        </div>

                        <div class="form-group">
                            <label for="">asal surat</label>
                            <input type="text" class="form-control" required name="asal_surat" value="{{ old('asal_surat') }}">
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
