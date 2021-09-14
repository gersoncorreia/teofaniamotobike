<?php

namespace App\Http\Controllers\Painel\Produto;

use App\Entrada;
use App\Entradas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prods = Produto::all();
        return $prods->toJson();
    }

    public function indexView(){
        $produtos = Produto::all();
        return view('painel.produtos.index',compact('produtos'));
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
        

        $prod = new Produto();


        $FormatoPonto = str_replace(['.',','], [',','.'], $request->input('precoC'));
        

        $prod->codigo_produto = $request->input('codigo');
        $prod->preco_custo = str_replace(',', '.', $request->input('precoC'));
        $prod->descricao = $request->input('descricao');
        $prod->categorias_id = $request->input('categoria_id');
        $prod->fornecedor_id = $request->input('fornecedor_id');
        $prod->marca_id = $request->input('marca_id');
        $prod->save();
        return json_encode($prod);
    }

    public function XMLProduto(Request $request){

        $arquivo_xml = simplexml_load_file($request->xml);

        foreach($arquivo_xml->NFe->infNFe->det as $item) {		
            $codigo = $item->prod->cProd;
            $xProd = $item->prod->xProd;
            $NCM = $item->prod->NCM;
            $CFOP = $item->prod->CFOP;
            $uCom = $item->prod->uCom;
            $qCom = $item->prod->qCom;
            $qCom = number_format((double) $qCom, 2, ".", ",");
            $vUnCom = $item->prod->vUnCom;
            $vUnCom = number_format((double) $vUnCom, 2, ".", ",");
            $vProd = $item->prod->vProd;
            $vProd = number_format((double) $vProd, 2, ".", ",");

            $prod = new Produto();

            $prod->codigo_produto = $codigo;
            $prod->descricao = $xProd;
            $prod->preco_custo = $vUnCom;
            $prod->save();

            $entrada = new Entradas();

            $entrada->codigo_produto = $codigo;
            $entrada->qtd = intval($qCom);
            $entrada->save();

/* 
            echo "----------------------------------------------------------------------";
            echo "<br>";
            echo "Codigo: ".$codigo." - Descrição do produto: ".$xProd ;
            echo "<br>";
            echo "Código NCM: ".$NCM." - ".$CFOP;
            echo "<br>";
            echo "Unidade Comercial: ".$uCom." - Quantidade Comercial: ".$qCom ;
            echo "<br>";            
            echo "Valor Unitário: ".$vUnCom." - Valor Total Bruto: ".$vProd."<br>" ;
            echo "----------------------------------------------------------------------"; */
            
        }
        //var_dump($arquivo_xml);
        //return json_encode($arquivo_xml);
        
        return redirect('/produtos');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Produto::find($id);
        if (isset($prod)) {
            //dd($prod);
            return json_encode($prod);            
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
    public function aplicarPorcentagem(Request $request)
    {
        
        $p = Produto::find($request->input('produto'));

        //var_dump($p);
        if(isset($p)){

           $precoC = $p->preco_custo;
           $calcPorcen = ($precoC * $request->input('porcentagem')) / 100;
           $precoV = ($precoC + $calcPorcen);
           $p->preco_venda = $precoV;
           $p->save();
          
        }
        
        return redirect('/produtos');
        
    }

    public function update(Request $request, $id)
    {
       
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
