@extends('layout.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-4">
            @if (session('success-status'))
                <div class="alert alert-success mt-2 mb-2 p-1">{{ session('success-status') }}</div>
            @elseif (session('error-status'))
                <div class="alert alert-danger mt-2 mb-2 p-1">{{ session('error-status') }}</div>
            @endif
                <div class="card h-100">
                <div class="card-body">
                    <h1 class="h3 mb-0 text-gray-800 mb-3">Cadastro de Usuário</h1>
                    <form method="POST" action="{{route('add-user')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col">
                                <label class="">Nome completo <span class="required"></span></label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                @error('name')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label class="">CPG/CNPJ <span class="required"></span></label>
                                <input type="text" class="form-control" name="cpfcnpj" value="{{old('cpfcnpj')}}">
                                @error('cpfcnpj')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label class="">E-mail <span class="required"></span></label>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                @error('email')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label class="">Senha <span class="required"></span></label>
                                <input type="password" class="form-control" name="password" value="{{old('password')}}">
                                @error('password')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label class="">Tipo de usuário <span class="required"></span></label>
                                <select class="custom-select" name="role">
                                    <option value="">Selecion o tipo de usuário</option>
                                    <option value="1">Comum</option>
                                    <option value="2">Lojista</option>
                                </select>
                                @error('role')
                                    <div class="alert alert-danger mt-2 mb-0 p-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-submit btn-success">
                                <span class="icon text-white mr-1">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Cadastrar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
