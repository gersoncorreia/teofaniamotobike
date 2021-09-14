<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('AdminLTE/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('AdminLTE/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('AdminLTE/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('AdminLTE/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>
<script type="text/javascript">

  $.ajaxSetup({

    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }

  });
  
  $('#produto').select2({
      theme: 'bootstrap4'
    })


      
  function novo() {
    $('#nome').val('');
    $('#email').val('');
    $('#senha').val('');
    
    $('#modal-novo-usuario').modal('show');
  }

  function novoProduto() {
    $('#codigo').val('');
    $('#nome').val('');
    $('#preco-custo').val('');
    $('#descricao').val('');
    $('#modal-novo').modal('show');
  }

  function finalizar(id) {
    console.log(id);
    $('#valorTotal').val('');
    $('#valorP').val('');
    $('#troco').val('');

    $.getJSON('/teofaniamotobike/public/vendas/show/'+ id, function(data) { 
      console.log(data);
      $('#idV').val(data.id);
      $('#valorTotal').val(data.valor_venda);
      $('#modal-finalizar').modal('show');
    });
  }

  function calcValor(){
    // zerando total
    document.getElementById("troco").value = '0';
 
    // valor líquido
    var VTOTALLIQUIDO = parseFloat(document.getElementById("valorTotal").value);
   
    // desconto em porcentagem
    var DESCONTO1 = parseFloat(document.getElementById("valorP").value);
    
    if( isNaN ( DESCONTO1 ) ){
    	DESCONTO1 = 0;
    }
 
    var TOTAL = (parseFloat(DESCONTO1) - parseFloat(VTOTALLIQUIDO));
    console.log(TOTAL);
 
    document.getElementById("troco").value = 'R$ ' + TOTAL.toFixed(2);
}

  function novoFornecedor() {
    $('#nomeFornecedor').val('');
    $('#nomeFantasia').val('');
    $('#cnpj').val('');
    $('#ins_estadual').val('');
    $('#obser').val('');
    $('#descricaoF').val('');
    $('#modal-novo-fornecedor').modal('show');
  }

  function novoCategoria() {
    $('#nomeCategoria').val('');
    $('#modal-novo-categoria').modal('show');
  }

  function novaMarca() {
    $('#nomeMarca').val('');
    $('#modal-novo-marca').modal('show');
  }

  
  function novaXML() {
    $('#xml').val('');
    $('#modal-novo-xml').modal('show');
  }
  
  function novoPorcentagem() {
    $('#porcentagem').val('');
    $('#modal-editar-produto').modal('show');
  }
  
  
  function montarLinha(p) {
    var linha = 
    "<tr>" +           
      "<td class='text-center'>" + p.id + "</td>" +
      "<td class='text-center'>" + p.codigo_produto + "</td>" +
      "<td class='text-center'>" + p.descricao + "</td>" +        
      "<td class='text-center'> R$ " + p.preco_custo + "</td>" +         
      /* "<td class='text-center'>" + p.preco_venda + "</td>" +  */         
      "<td class='text-center'>" +
        '<button class="btn btn-sm btn-outline-primary" onclick="editar(' + p.id + ')"><i class="nav-icon fas fa-edit"></i> Editar </button> ' +
        /* '<button class="btn btn-sm btn-outline-danger" onclick="remover(' + p.id + ')"><i class="nav-icon fas fa-trash-alt"></i> Apagar </button> ' + */
      "</td>" +             
    "</tr>";
    return linha;
  }

  function montarLinhaInput(p, q) {
    var preco = parseFloat(p.preco_custo);
    var total = parseFloat(preco * q.quantidade);
    var linha = 
    "<tr>" +           
      
 
      "<td class='text-center'><input name='id[]' hidden type='text' class='form-control' value='" + p.id + "'>"+
      "<input name='codigo[]' hidden type='text' class='form-control' value='" + p.codigo_produto + "' >" + p.codigo_produto + "</td>" +
      "<td class='text-center'><input name='nome[]' hidden type='text' class='form-control' id='nome' value='" + p.descricao + "' >" + p.descricao + "</td>" +      
      "<td class='text-center'><input name='preco[]' hidden type='text' class='form-control' id='preco-custo' value='" + p.preco_custo + "' >" + p.preco_custo + "</td>" +      
      "<td class='text-center'><input name='quantidade[]'hidden type='text' class='form-control' id='quantidade' value='" + q.quantidade + "' >" + q.quantidade + "</td>" +      
      "<td class='text-center'><input name='total[]'hidden type='text' class='form-control' id='total' value='" + total + "' >" +total + "</td>" +      
      "<td class='text-center'>" +        
        '<button class="btn btn-sm btn-outline-danger" onclick="removerProdutoVenda(' + p.id + ')"><i class="nav-icon fas fa-trash-alt"></i> Retirar item </button> ' +
      "</td>" +             
    "</tr>";
    return linha;
  }


  
    
  

  /* function carregarProdutos() {
    $.getJSON('/teofaniamotobike/public//api/produtos', function(produtos) { 
      for(i=0;i<produtos.length;i++) {
        linha = montarLinha(produtos[i]);
        $('#tbproduto>tbody').append(linha);
                
      }
    });        
  } */

  function carregarCategorias() {
    $.getJSON('/teofaniamotobike/public/api/categorias', function(data) { 
      for(i=0;i<data.length;i++) {
        opcao = '<option value ="' + data[i].id + '">' + 
        data[i].nome + '</option>';
        $('#categoria').append(opcao);
      }
    });
  }

  function carregarFornecedor() {
    $.getJSON('/teofaniamotobike/public/api/fornecedores', function(data) { 
      
      for(i=0;i<data.length;i++) {
        opcao = '<option value ="' + data[i].id + '">' + 
        data[i].nome + '</option>';
        $('#fornecedor').append(opcao);
      }
    });
  }

  function carregarMarcas() {
    $.getJSON('/teofaniamotobike/public/api/marcas', function(data) { 
      for(i=0;i<data.length;i++) {
        opcao = '<option value ="' + data[i].id + '">' + 
        data[i].nome + '</option>';
        $('#marca').append(opcao);
      }
    });
  }
  function criarProduto() {
    prod = { 
      codigo: $("#codigo").val(), 
      nome: $("#nome").val(), 
      precoC: $("#preco-custo").val(), 
      descricao: $("#descricao").val(), 
      fornecedor_id: $("#fornecedor").val(), 
      categoria_id: $("#categoria").val(), 
      marca_id: $("#marca").val() 
    };
    
    $.post("/api/produtos", prod, function(data) {
      produto = JSON.parse(data);
      linha = montarLinha(produto);
      $('#tbproduto>tbody').append(linha);            
    });
  }

  function addProduto() {
    produ = { 
      id: $("#produto").val(), 
      nome: $("#nome").val(), 
      preco_custo: $("#preco-custo").val(),
      quantidade: $("#quantidade").val(),
    };

    $.getJSON('/teofaniamotobike/public/api/produtos/'+ produ.id, function(data) { 
      /* console.log(data); */
     // produto = JSON.parse(data);
           
      linha = montarLinhaInput(data,produ);
      $('#tbvenda>tbody').append(linha);
      $('#formAddProduto')[0].reset();          
    });    
  }


  function removerProdutoVenda(id) {
        $.ajax({
            type: "DELETE",
            url: "/teofaniamotobike/public/api/produtos/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tbvenda>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
  }



 /*  function criarFornecedor() {
    prod = { 
      nome: $("#nomeFornecedor").val(), 
      nomefantasia: $("#nomeFantasia").val(), 
      cnpj: $("#cnpj").val(), 
      inscricao: $("#ins_estadual").val(), 
      obs: $("#obser").val(), 
      descricao: $("#descricaoF").val() 
    };

    $.post("/api/produtos", prod, function(data) {
      produto = JSON.parse(data);
      linha = montarLinha(produto);
      $('#tabelaProdutos>tbody').append(linha);            
    });
  }

  function criarCategoria() {
    prod = { 
      nome: $("#nomeCategoria").val(), 
     
    };

    $.post("/api/produtos", prod, function(data) {
      produto = JSON.parse(data);
      linha = montarLinha(produto);
      $('#tabelaProdutos>tbody').append(linha);            
    });
  }

  function criarMarca() {
    prod = { 
      nome: $("#nomeMarca").val(), 
    };

    $.post("/api/produtos", prod, function(data) {
      produto = JSON.parse(data);
      linha = montarLinha(produto);
      $('#tabelaProdutos>tbody').append(linha);            
    });
  } */


  $("#formAdicionar").submit( function(event){ 
    event.preventDefault(); 
    /* if ($("#id").val() != '') */
    console.log('deu certo para salvar');
      //salvarProduto();
    /* else */
     criarProduto();    
    $("#modal-novo").modal('hide');
  });
  
  $("#formAddProduto").submit( function(event){ 
    event.preventDefault(); 
    /* console.log('deu certo para salvar'); */
    addProduto();       
  });
  


$(function () {

  $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
  });

  $('#tbprodut').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "responsive": true,
    
  });

  /* carregarProdutos() */
  carregarMarcas()
  carregarFornecedor()
  carregarCategorias()

  $(document).ready(function(){
    //$(selector).inputmask("aa-9999");  //static mask
    $('#documento').inputmask({mask: "999.999.999-99"});  //static mask
    $('#cnpj').inputmask({mask: "99.999.999/9999-99"});  //static mask
    //$ ('#preco-custo'). inputmask ( ' R$ [9.999,99] ' , {ganacioso :  false });
    $('#preco-custo').mask('#,##0.00', {reverse: true});
    $('#total').mask('#,##0.00', {reverse: true});
  });


  $('#filtro-nome').keyup(function() {
    var nomeFiltro = $(this).val().toLowerCase();
    $('table tbody').find('tr').each(function() {
        var conteudoCelula = $(this).find('td:first').text();
        var corresponde = conteudoCelula.toLowerCase().indexOf(nomeFiltro) >= 0;
        $(this).css('display', corresponde ? '' : 'none');
    });
  });
});


  
 
  
</script>
</body>
</html>