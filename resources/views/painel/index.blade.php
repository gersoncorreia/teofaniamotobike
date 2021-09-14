@extends('painel.layout.index')
@section('content')
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Painel Principal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('painel.index')}}">Painel</a></li>
              <li class="breadcrumb-item active">Principal</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @if(Auth::user()->tipo == 1)
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">    
                  <h3>0</h3>
                  <p>Novos pedidos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Ir para pedidos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  @inject('contaUsu', 'App\User')                
                  <h3>{{$contaUsu->count()}}</h3>

                  <p>Usuários Registrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('usuarios.index')}}" class="small-box-footer">Ir para usuários <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
        @else
          @if(Auth::user()->tipo == 2) 
            <div class="content">
              <div class="container">
                <div class="col-12">
                  <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                      {{-- <form action="#" method="POST">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Informe nome do produto ou código/código de barra"  name="nome" id="nome">
                      </div>
                      </form> --}}
                      <a href="/teofaniamotobike/public/vendas" class="btn btn-sm btn-outline-success">
                        <i class="nav-icon fas fa-edit"></i> Fazer Venda
                      </a>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Produtos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body " style=" width:100%;">
                      <table class="table table-bordered table-hover" id="tbprodut">
                        <thead>
                          <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Código do Produto</th>
                            <th class="text-center">Descrição</th>
                          
                            <th class="text-center">Preço</th>
                            <th class="text-center">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($produtos as $pro )
                            <tr>
                              <td class="text-center">{{$pro->id}}</td>
                              <td class="text-center">{{$pro->codigo_produto}}</td>
                              <td>{{$pro->descricao}}</td>
                              <td class="text-center"> R$ {{$pro->preco_custo}}</td>                    
                              <td>
                                <a href="/usuarios/edit/{{$pro->id}}" class="btn btn-sm btn-outline-primary">Editar</a>
                                {{-- <a href="/usuarios/delete/{{$pro->id}}" class="btn btn-sm btn-outline-danger">Apagar</a> --}}
                              </td>
                            </tr>
                        @endforeach
                        </tbody>

                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
            </div>
          @else
            @if(Auth::user()->tipo == 3)
              <div class="content">
                <div class="container">
                  <div class="col-12">
                    <div class="card">

                      <!-- /.card-header -->
                      <div class="card-body">
                        {{-- <form action="#" method="POST">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Informe nome do produto ou código/código de barra"  name="nome" id="nome">
                        </div>
                        </form> --}}
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Registro de Vendas</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body " style=" width:100%;">
                        <table class="table table-bordered table-hover" id="tbprodut">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">Desconto</th>
                              <th class="text-center">Valor Total</th>
                              <th class="text-center">Forma de Pagamento</th>
                              <th class="text-center">Estado da Venda</th>
                              <th class="text-center">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($vendas as $v )
                              <tr>
                                <td class="text-center">{{$v->id}}</td>
                                {{-- <td class="text-center">{{$v->cliente_id}}</td> --}}
                                <td class="text-center">{{$v->desconto}} %</td>
                                <td class="text-center"> R$ {{$v->valor_venda}}</td>                    
                                <td class="text-center">{{$v->tipo_pagamento}}</td>                    
                                <td class="text-center">
                                  @if ($v->status == 'pendente')
                                      <span class="text-warning"> {{$v->status}}</span>
                                  @else 
                                    @if($v->status == 'pago')
                                      <span class="text-success"> {{$v->status}}</span>
                                    @else 
                                    <span class="text-danger"> {{$v->status}}</span>
                                    @endif
                                  @endif
                              
                                </td>                    
                                <td class="text-center">
                                  <a {{-- href="teofaniamotobike/public/vendas/edit/{{$v->id}}" --}} class="btn btn-sm btn-outline-primary" onclick="finalizar({{$v->id}})">Finalizar venda</a>
                                  {{-- <a href="/usuarios/delete/{{$pro->id}}" class="btn btn-sm btn-outline-danger">Apagar</a> --}}
                                </td>
                              </tr>
                            
                            @endforeach
                          </tbody>

                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  
                </div><!-- /.container-fluid -->
              </div>
              <!-- /.content -->
              </div>
            @endif
          @endif
        @endif
    </section>
    <!-- /.content -->

     <!-- Modal Produto -->  
     <div class="modal fade" id="modal-finalizar">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Adicionar novo Usuário</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form  action="/teofaniamotobike/public/vendas/imprimir" method="POST">
              {{ csrf_field() }}
              <input type="text" class="form-control" hidden name="idV" id="idV" >
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                  </div>
                  <input type="text" class="form-control"   name="valorTotal" id="valorTotal" >
              </div>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Valor de pagamento" onblur="calcValor()" name="valorP" id="valorP"  required>
              </div>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Descrição do produto" name="troco" id="troco" readonly="readonly" required >
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
@endsection