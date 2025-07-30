@extends('layout.app')

@section('content')

    <div class="row">
        <div class="col-6">
            <div class="card h-100">
                <div class="card-body">
                    <h1 class="h3 mb-0 text-gray-800 mb-3">Olá, {{ auth()->user()->name }}</h1>
                    <h2>Saldo na carteira: <span class="font-weight-bolder">R$ @money(1221.03) </span></h2>

                    @if (auth()->user()->type == \App\Models\User::COMMON_USER)
                        <a  href="new-transfer" class="btn btn-primary">Realizar nova transferência</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
