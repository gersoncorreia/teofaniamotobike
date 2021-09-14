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
                  <div class="card-body p-0">
                      <div class="row p-5">
                          <div class="col-md-6">
                              <img src="http://via.placeholder.com/400x90?text=logo">
                          </div>
  
                          <div class="col-md-6 text-right">
                              <p class="font-weight-bold mb-1">Invoice #550</p>
                              <p class="text-muted">Due to: 4 Dec, 2019</p>
                          </div>
                      </div>
                      <div class="col-12">
                        <div class="card">
        
                          <!-- /.card-header -->
                          <div class="card-body">
                            <form action="" id="formAddProduto" method="POST">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <select name="produto" id="produto" class="form-control select2 select2-danger">                               
                                                <option selected>Selecionar....</option>
                                                @foreach ($prod as $p)
                                                    <option value="{{$p->id}}"> {{$p->codigo_produto}} - {{$p->descricao}} </option>
                                                @endforeach   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <div class="input-group mb-2">                                            
                                            <input type="text"  class="form-control" placeholder="Quantidade"  name="quantidade" id="quantidade">
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="input-group mb-3">
                                            <button type="submit" class="btn btn-outline-secondary">
                                                <i class="nav-icon fas fa-save"></i> Adicionar Produto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <hr class="my-5">
{{--   
                      <div class="row pb-5 p-5">
                          <div class="col-md-6">
                              <p class="font-weight-bold mb-4">Client Information</p>
                              <p class="mb-1">John Doe, Mrs Emma Downson</p>
                              <p>Acme Inc</p>
                              <p class="mb-1">Berlin, Germany</p>
                              <p class="mb-1">6781 45P</p>
                          </div>
  
                          <div class="col-md-6 text-right">
                              <p class="font-weight-bold mb-4">Payment Details</p>
                              <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                              <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                              <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                              <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
                          </div>
                      </div>
   --}} 
                     <form action="/teofaniamotobike/public/vendas/cadVendas" method="POST">
                      {{ csrf_field() }}
                      <div class="row ">
                          <div class="col-md-12">
                            
                              <div class="card">
                                <div class="card-body table-responsive p-0" style="height: 200px;">
                                <table class="table table-head-fixed text-nowrap" id="tbvenda">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="border-0 text-uppercase small font-weight-bold text-center">Código do Produto</th>
                                            <th class="border-0 text-uppercase small font-weight-bold text-center">Descrição</th>
                                            <th width="10%" class="border-0 text-uppercase small font-weight-bold text-center">Preço</th>
                                            <th width="5%" class="border-0 text-uppercase small font-weight-bold text-center">Quantidade</th>
                                            <th width="10%" class="border-0 text-uppercase small font-weight-bold text-center">Total</th>
                                            <th width="15%" class="border-0 text-uppercase small font-weight-bold text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                    </tbody>
                                   {{--  <tfoot>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td><select name="produto" id="produto" class="form-control">                               
                            <option selected>Forma de Pagamento</option> 
                            <option value="credito">Cartão Credito</option> 
                            <option value="debito">Cartão Débito</option> 
                            <option value="dinheiro">Dinheiro</option> 
                          </select></td>
                                      </tr>
                                    </tfoot> --}}
                                </table>
                                </div>
                              </div>
                          </div>
                      </div>
                    <div class="card">
        
                      <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-sm-3">
                              <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                  <select name="formapagamento" id="formapagamento" class="form-control">                               
                                    <option selected>Forma de Pagamento</option> 
                                    <option value="credito">Cartão Credito</option> 
                                    <option value="debito">Cartão Débito</option> 
                                    <option value="dinheiro">Dinheiro</option> 
                                  </select>
                                  
                                </div>
                              </div>
                              <div class="form-group col-2">
                                <div class="input-group mb-2">                                            
                                    <input type="text"  class="form-control" placeholder="Desconto %"  name="desconto" id="desconto">
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                      <div class="d-flex flex-row-reverse bg-dark text-white p-4">  
                          <div class="py-3 px-5 text-right">
                            <button type="submit" class="btn btn-lg btn-outline-success">
                                <i class="nav-icon fas fa-save"></i> Finalizar Venda
                            </button>
                          </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>

      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection