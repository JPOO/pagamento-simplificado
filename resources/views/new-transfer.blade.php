@extends('layout.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-4">
            @if (session('success-status'))
                <div class="alert alert-success h5 mt-2 mb-2 p-1">{{ session('success-status') }}</div>
            @elseif (session('error-status'))
                <div class="alert alert-danger h5 mt-2 mb-2 p-1">{{ session('error-status') }}</div>
            @endif
                <div class="card">
                <div class="card-body">
                    <h1 class="h3 mb-0 text-gray-800 mb-3">Nova transferência</h1>
                    <form method="POST" action="{{route('add-transfer')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col">
                                <label class="">CPF/CNPJ destino <span class="required"></span></label>
                                <p class="small">Você pode transferir para outros usuários comuns e lojistas.</p>
                                <input type="text" class="form-control" name="cpfcnpj" value="{{old('cpfcnpj')}}">
                                @error('cpfcnpj')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label class="">Valor (R$) <span class="required"></span></label>
                                <p class="small">Digite o valor em reais.</p>
                                <input type="text" class="form-control" name="value" value="{{old('value')}}" data-mask="#.##0,00" data-mask-clearifnotmatch="true" data-mask-reverse="true">
                                @error('value')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-submit btn-success">
                                <span class="icon text-white mr-1">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Transferir</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
