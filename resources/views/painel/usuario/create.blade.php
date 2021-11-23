@extends('painel.template.index')

@section('content')

<form action="{{ route('painel.usuario.store') }}"  method="POST">
    @csrf
    <div class="form-group row align-items-center mb-0">
        <label for="board" class="col-1 text-right control-label col-form-label">Nome:</label>
        <div class="col-5  pb-2 pt-2">
            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus placeholder="Digite o nome"/>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <label for="board" class="col-1 text-right control-label col-form-label">Tipo:</label>
        <select name="role_id" class="col-5 text-right control-label col-form-label  {{ $errors->has('role_id') ? ' is-invalid' : '' }} custom-select">
            <option {{ old('role_id') == null ? "selected" : "" }} value="">Selecione o tipo:</option>
            <option {{ old('role_id') == 2 ? "selected" : "" }} value="2">Gestor</option>
            <option {{ old('role_id') == 3 ? "selected" : "" }} value="3">Produtor</option>
            <option {{ old('role_id') == 4 ? "selected" : "" }} value="4">Fornecedor</option>
        </select>
        @error('role')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group row align-items-center mb-0">
        <label for="documento" class="col-1 text-right control-label col-form-label">E-mail:</label>
        <div class="col-5 pb-2 pt-2">
            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  value="{{ old('email') }}" autofocus placeholder="Digite o email"/>
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <label for="documento" class="col-1 text-right control-label col-form-label">CPF/CNPJ:</label>
        <div class="col-5 pb-2 pt-2">
            <input type="text" class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" name="documento"  value="{{ old('documento') }}" placeholder="Digite a CPF ou CNPJ"/>
            @error('documento')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center mb-0">
        <label for="password" class="col-1 text-right control-label col-form-label">Senha:</label>
        <div class="col-5 pb-2 pt-2">
            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autofocus placeholder="Digite a senha"/>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <label for="repitaSenha" class="col-1 text-right control-label col-form-label">Confirmar senha:</label>
        <div class="col-5 pb-2 pt-2">
            <input type="password" class="form-control" name="repitaSenha" placeholder="Repita a senha"/>
        </div>
    </div>
    <button type="submit" class="btn btn-success ml-5">Cadastrar</button>
    <button type="reset" class="btn btn-secondary ml-1">Limpar</button>
</form>
@endsection
