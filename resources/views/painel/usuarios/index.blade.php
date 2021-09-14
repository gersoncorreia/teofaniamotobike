@extends('painel.layout.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Painel Usuários</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{route('painel.index')}}">Painel</a> 
              </li>
              <li class="breadcrumb-item active">Usuários</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listagem geral de Usuários | 
                  {{-- <a href="/usuarios/create" class="btn btn-sm btn-outline-success">Novo Usuário</a> --}}
                  <button type="button" class="btn btn-sm btn-outline-success" role="button" onClick="novo()">
                    Novo Usuário
                  </button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Tipo</th>
                      <th>Cadastro</th>                      
                      <th>Última Alteração</th>                      
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                      @foreach ($usuarios as $us )
                        @if($us->status == 0)
                         <tr>
                           <td> - </td>
                           <td> - </td>
                           <td> - </td>
                           <td> - </td>
                           <td> - </td>
                           <td> - </td>
                           <td> - </td>
                         </tr>
                        @else
                          @if($us->status == 1) 
                            <tr>
                              <td>{{$us->id}}</td>
                              <td>{{$us->name}}</td>
                              <td>{{$us->email}}</td>
                              <td>
                                @if($us->tipo == 1)
                                  Administrador
                                @else 
                                  @if($us->tipo == 2)
                                    Balcão
                                  @else
                                    @if($us->tipo == 3)
                                      Caixa
                                    @endif
                                  @endif
                                @endif                
                                </td>
                                <td>{{$us->created_at->diffForHumans()}}</td>
                                <td>{{$us->updated_at->diffForHumans()}}</td>
                                <td>
                                  <a href="/teofaniamotobike/public/usuarios/edit/{{$us->id}}" class="btn btn-sm btn-outline-primary">Editar</a>
                                  <a href="/teofaniamotobike/public/usuarios/delete/{{$us->id}}" class="btn btn-sm btn-outline-danger">Apagar</a>
                                </td>
                            </tr>
                            @endif
                        @endif
                      @endforeach
                  </tbody>                              
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->  
            <div class="modal fade" id="modal-novo-usuario">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Adicionar novo Usuário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/teofaniamotobike/public/usuarios/store" method="POST" >
                      {{ csrf_field() }}
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Nome do Usuário"  name="nome" id="nome">
                      </div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                          </div>
                          <input type="email" class="form-control" placeholder="Email"  name="email" id="email" required>
                      </div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" class="form-control" placeholder="Senha" name="senha" id="senha" required >
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
                     
                     
                      <div class="modal-footer justify-content-between">
                        <button type="cancel" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-outline-success">Salvar Informações</button>
                      </div>
                  </form>
                  </div>

                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </div>
          <!-- /.col -->
       {{--    @if(isset($resposta))
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
              @endif --}}
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection