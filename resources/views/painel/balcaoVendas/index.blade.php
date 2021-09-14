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
                <a href="{{route('painel.balcao.index')}}">Painel</a> 
              </li>
              <li class="breadcrumb-item active">Balcão</li>
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
                <h3 class="card-title">Listagem geral de produtos | 
                  {{-- <a href="/usuarios/create" class="btn btn-sm btn-outline-success">Novo Usuário</a> --}}
                  <button type="button" class="btn btn-sm btn-outline-success" role="button" onClick="novo()">
                    Novo Usuário
                  </button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->  
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection