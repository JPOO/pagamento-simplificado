@extends('layout.app')

@section('content')

    <div class="row">
        <div class="col-6">
            <div class="card h-100">
                <div class="card-body">
                    <h1 class="h3 mb-0 text-gray-800 mb-3">Olá, {{ auth()->user()->name }}</h1>
                    <h2>Saldo na carteira: <span class="font-weight-bolder">R$ @money($amount) </span></h2>

                    @if (auth()->user()->role == \App\Models\User::COMMON_USER)
                        <a href="new-transfer" class="btn btn-primary">Realizar nova transferência</a>
                    @else
                        <p>Usuários lojistas não podem realizar transferências.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
