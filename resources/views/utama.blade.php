@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Agung Gumelars') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h2>Tong Hilaf Ngopi</h2>
                    <p>29 januari 2021</p>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
