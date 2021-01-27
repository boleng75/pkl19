@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Data Kelurahan') }}</b></center></div>

                <div class="card-body">
                <form action="{{route('kelurahan.store')}}" method="POST">
                @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            
                <div class="mb-3">
                        <label for="" class="form-label">Kecamatan</label>
                       <select name="id_kecamatan" class="form-control" id="">
                       @foreach($kecamatan as $data)
                       <option value="{{$data->id}}">{{$data->nama_kecamatan}}</option>
                       @endforeach
                       </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kode Kelurahan</label>
                        <input type="text" name="kode_kelurahan" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama kelurahan</label>
                        <input type="text" name="nama_kelurahan" class="form-control" id="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
