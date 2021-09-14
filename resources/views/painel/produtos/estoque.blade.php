@extends('painel.layout.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Painel Protudos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{route('painel.index')}}">Painel</a> 
              </li>
              <li class="breadcrumb-item active">Estoque</li>
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
                <h2 class="card-title">Ações Rápidas 
                 
                  {{-- <a href="/usuarios/create" class="btn btn-sm btn-outline-success">Novo Usuário</a> --}}
                </h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(Auth::user()->tipo == 1)
                  
                  <button type="button" class="btn btn-sm btn-outline-success" role="button" onClick="novoProduto()">
                    <i class="nav-icon fas fa-cube"></i> Adicionar Produto
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-success" role="button" onClick="novoPorcentagem()">
                    <i class="nav-icon fas fa-cube"></i> Adicionar Porcentagem
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-success" role="button" onClick="novaXML()">
                    <i class="nav-icon fas fa-handshake"></i> Enviar Arquivo XML
                  </button>
                @else 
                  @if(Auth::user()->tipo == 2)
                    <button type="button" class="btn btn-sm btn-outline-success" role="button" onClick="novoProduto()">
                      <i class="nav-icon fas fa-cube"></i> Adicionar Produto
                    </button>
                    <a href="/teofaniamotobike/public/vendas" class="btn btn-sm btn-outline-success">
                      <i class="nav-icon fas fa-edit"></i> Fazer Venda
                    </a>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card"> 
              <div class="card-header">
                <h3 class="card-title">Listagem geral de Estoque
                  {{-- <a href="/usuarios/create" class="btn btn-sm btn-outline-success">Novo Usuário</a> --}}
                </h3>
              </div>             
              <div class="card-body">
                <table id="tbprodut" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th class="text-center">Código Produto</th>
                      <th class="text-center">Descrição</th>
                      <th class="text-center">Preço Venda</th>
                     {{--  <th>Preço de Venda</th>        --}}              
                      <th class="text-center">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produtos as $prod )
                      <tr>
                        <td class="text-center">{{$prod->id}}</td>
                        <td class="text-center">{{$prod->codigo_produto}}</td> 
                        <td>{{$prod->descricao}}</td>
                        <td class="text-center">R$ {{$prod->preco_venda}}</td>
                        <td class="text-center">
                          <a href="/teofaniamotobike/public/produtos/edit/{{$prod->id}}" class="btn btn-sm btn-outline-primary">
                            <i class="nav-icon fas fa-edit"></i> Editar
                          </a>
                          <a href="/teofaniamotobike/public/produtos/delete/{{$prod->id}}" class="btn btn-sm btn-outline-danger">
                              <i class="nav-icon fas fa-trash-alt"></i> Apagar
                          </a>
                          
                        </td>
                      </tr>
                    @endforeach
                  </tbody>                              
                </table>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->  

            <!-- Modal Produto -->  
            <div class="modal fade" id="modal-novo">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Adicionar novo Usuário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form  id="formAdicionar">
                      {{-- {{ csrf_field() }} --}}
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Código do Produto"  name="codigo" id="codigo">
                      </div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Preço de cutsto"  name="preco-custo" id="preco-custo"  required>
                      </div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Descrição do produto" name="descricao" id="descricao" required >
                      </div>
                     
                      <div class="modal-footer justify-content-between">
                        <button type="cancel" class="btn btn-outline-secondary" data-dismiss="modal">
                          <i class="nav-icon fas fa-times-circle"></i>  Fechar
                        </button>
                        <button type="submit" class="btn btn-outline-success">
                          <i class="nav-icon fas fa-save"></i> Salvar Informações
                        </button>
                      </div> 
                    </form>
                  </div>
                  
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection