@extends('layout.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-4">
            @if (session('status'))
                <div class="alert alert-danger mt-2 mb-2 p-1">{{ session('status') }}</div>
            @endif
            <div class="card h-100">
                <div class="card-body">
                    <h1 class="h3 mb-0 text-gray-800 mb-3">Login</h1>
                    <form method="POST" action="{{route('login')}}">
                        @csrf
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
                        <div class="text-center">
                            <button type="submit" class="btn btn-submit btn-success">
                                <span class="icon text-white mr-1">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Entrar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
