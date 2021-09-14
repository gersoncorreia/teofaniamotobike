<?php

namespace App\Http\Controllers\Painel\Vendas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Itens;
use App\Produto;
use App\Saidas;
use App\Vendas;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexView(){
        $prod = Produto::all();
        return view('painel.vendas.index', compact('prod'));
    }

    public function vendaListagem(){

        $vend = Vendas::all();
        return view('painel.vendas.list',compact('vend'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = json_encode($request);
        return $dados;
    }

    public function cadVendas(Request $request){

        $somaTotal = 0;
        $cont = count($request->codigo);

        for ($i = 0; $i < $cont; $i++) { 
            $somaTotal += $request->total[$i];
        }

        $venda = new Vendas();
    
        $venda->desconto = $request->input('desconto');
        $venda->tipo_pagamento = $request->input('formapagamento');
        $venda->valor_venda = $somaTotal;
        $venda->save();

        $insertID = $venda->id;

        for($i = 0; $i <$cont; $i++){

            $item = new Itens();

            $item->codigo_produto = $request->codigo[$i];
            $item->qtd = $request->quantidade[$i];
            $item->valor_total = $request->total[$i];
            $item->produtos_id = $request->id[$i];
            $item->vendas_id = $insertID;
            $item->save();

            $insertSaidaID = $item->id;

            $saida = new Saidas();
            $saida->itens_id = $insertSaidaID;
            $saida->save();
        }

        return redirect('/vendas');
      
    
    }

    public function ImprimirRecibo(Request $request ){

        $idVenda = $request->input('idV');
        $valorVend = $request->input('valorTotal');
  
        $valorPag = number_format((double) $request->input('valorP'), 2, ".", ",");

        $venda = Vendas::find($idVenda);

        if(empty($venda->desconto)){
            $descont = 0;
        }else{
            $descont = $venda->desconto;
        }

        $valorDesconto = ($descont * $valorVend) / 100;

        $totalDesconto = $valorVend - $valorDesconto;

        $troco =  $valorPag - $valorVend;

        $totalFormat = number_format((double) $totalDesconto, 2, ".", ",");

        $venda->valor_pagamento = $request->input('valorP');
        $venda->status = 'pago';
        $venda->update();

        $nombre_impresora = "ELGIN7"; 
        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector); 

        # Vamos a alinear al centro lo próximo que imprimamos
       /*  $printer->setJustification(Printer::JUSTIFY_CENTER);
        /*
            Ahora vamos a imprimir un encabezado
        */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("\n"."Teofania - MotoBike" . "\n");
        $printer->text("Diretor: Alercio Leandro " . "\n");
        $printer->text(" Tel: (68) 9.9963-6221 " . "\n");
        #La fecha también
        date_default_timezone_set("America/Manaus");
        $printer->text(date("d/m/Y H:i:s") . "\n");
        $printer->text("------------------------------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("| QTD  |  DECRICAO  |  P.U  | Valor Total.\n");
        $printer->text("------------------------------------------------"."\n");
        /*
            Ahora vamos a imprimir los
            productos
        */
        /*Alinear a la izquierda para la cantidad y el nombre*/
            $printer->setJustification(Printer::JUSTIFY_LEFT);

            //$item = Itens::all();

            $itemJoin = DB::table('itens')
                ->join('produtos','itens.produtos_id','=','produtos.id')
                ->select('itens.*','itens.codigo_produto','produtos.descricao','produtos.preco_custo','produtos.preco_venda')
                ->where('itens.vendas_id', '=', $idVenda)
                ->get();
            
            $cont = count($itemJoin);

            foreach($itemJoin as $item){
                $printer->text( " ".$item->descricao."\n");  
                $printer->text( "  ". $item->qtd ." un * R$ ".$item->preco_custo." = R$ ".$item->valor_total."\n");  
            }
            
        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("------------------------------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("SUBTOTAL: R$ ". $valorVend."\n");
        $printer->text("Desconto: ".$descont."%\n");
        $printer->text("TOTAL: R$ ".$totalFormat."\n");
        $printer->text("Total pago: R$ ".$valorPag."\n");
        $printer->text("Troco: R$ ".$troco."\n");

        /*
            Podemos poner también un pie de página
        */
        
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("------------------------------------------------"."\n");
        $printer->text("Este cupom não tem valor fiscal.\n");
        $printer->text("Obrigado pelas compras! VOLTE SEMPRE!\n");
        $printer->text("------------------------------------------------"."\n");
        
        /*Alimentamos el papel 3 veces*/
        $printer->feed(2);

        $printer->cut();
        $printer->pulse();
        $printer->close();
        return redirect('/painel');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vend = Vendas::find($id);
        if (isset($vend)) {
            //dd($prod);
            return json_encode($vend);            
        }
        return response('Produto não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
