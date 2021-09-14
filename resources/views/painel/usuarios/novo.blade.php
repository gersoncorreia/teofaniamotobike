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
                <li class="breadcrumb-item active">Adicionar novo Usuário</li>
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
                    <h3 class="card-title">Informações do Usuário</h3>
                </div>
                <div class="card-body">
                    <form action="/teofaniamotobike/public/usuarios/store" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nome do Usuário"  name="nome">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email"  name="email" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Senha" name="senha" required >
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                            </div>
                            <select name="tipo" class="form-control">                               
                                <option value="1">Selecionar....</option>
                                <option value="1">Administrador</option>
                                <option value="2">Balcão</option>
                                <option value="3">Caixa</option>     
                            </select>
                        </div>                        
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-block btn-outline-success">Salvar</button>
                            <button type="cancel" class="btn btn-block btn-outline-secondary">Cancelar</button>
                        </div>
                        @if(isset($resposta))
                          @if($resposta == "sucesso")
                              <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                Usuário cadastrado com Sucesso.
                              </div>
                            @else 
                              <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Falha!</h5>
                                Falha ao cadastrar as informações do usuário!
                              </div>
                            @endif
                        @endif
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
  @endsection