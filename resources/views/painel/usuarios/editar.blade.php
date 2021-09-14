@extends('painel.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Painel Usuários</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('painel.index')}}">Painel</a></li>
                <li class="breadcrumb-item active">Editar Usuário</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    <!-- Main content -->
    <hr>
    <section class="content">
        <div class="container-fluid col-sm-6 col-md-6">
            <!-- Input addon -->
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Editar informações do Usuário</h3>
                </div>
                <div class="card-body">
                    <form action="/teofaniamotobike/public/usuarios/update/{{$usuario->id}}" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nome do Usuário" value="{{$usuario->name}}" name="nome">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email" value="{{$usuario->email}}" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Senha" name="senha" >
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                            </div>
                            <select name="tipo" class="form-control">                               
                                    @if($usuario->tipo == 1)
                                        <option value="1">Administrador</option>
                                        <option value="2">Balcão</option>
                                        <option value="3">Caixa</option>
                                    @else
                                        @if($usuario->tipo == 2)
                                            <option value="2">Balcão</option>
                                            <option value="1">Administrador</option>
                                            <option value="3">Caixa</option>
                                        @else
                                            @if($usuario->tipo == 3)
                                                <option value="3">Caixa</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Balcão</option>
                                            @endif
                                        @endif
                                    @endif
                            </select>
                        </div>
                        <div class="input-group mb-3">                            
                            @if($usuario->status == 1)                          
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="1"  checked>
                                    <label for="customRadio1" class="custom-control-label">Ativo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="status" value="0">
                                    <label for="customRadio2" class="custom-control-label">Desativado</label>
                                </div>
                            @else 
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="1" >
                                    <label for="customRadio1" class="custom-control-label">Ativo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="status" value="0" checked>
                                    <label for="customRadio2" class="custom-control-label">Desativado</label>
                                </div>
                            @endif
                         
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-block btn-outline-warning">Editar</button>
                            <button type="cancel" class="btn btn-block btn-outline-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
  @endsection