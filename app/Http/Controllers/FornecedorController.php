<?php

namespace projeto_laravel\Http\Controllers;

use Illuminate\Support\Facades\DB;
use projeto_laravel\Fornecedor;
use Request;
use projeto_laravel\Http\Requests\FornecedoresRequest;

class FornecedorController extends Controller
{
	public function __construct()
	{
		  $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$fornecedores = Fornecedor::all();
		return view('fornecedor.fornecedores_index')->with('fornecedores',$fornecedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	return view('fornecedor.novo_fornecedor');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedoresRequest $request){
			$params = request::all();
			Fornecedor::create($params);
		
				/*	return redirect()
					->action('FornecedorController@lista')
					->withInput(Request::only('nome'));
	*/
			return redirect()
					->route('fornecedor.index')
					->withInput(Request::only('nome'));
					
	}	
    /**
     * Display the specified resource.
     *
     * @param  \projeto_laravel\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */

  public function lista(){
	if(DB::connection()->getDatabaseName())
	   {
	     echo "connected sucessfully to database ",DB::connection()->getDatabaseName();
	   }
		
		$fornecedores = Fornecedor::all();

		

		//return view('fornecedors_index')->with('fornecedors',$fornecedors);

		return view('fornecedor.fornecedores_listagem');
	}
	



    public function show(Fornecedor $fornecedor)
    {
        //
			return view('fornecedor.fornecedor_mostra')->with('fornecedor',$fornecedor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \projeto_laravel\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$fornecedor = Fornecedor::find($id);
		echo "editar produto".$id;
		return view('fornecedor.fornecedor_editar')->with('f', $fornecedor);
	
		  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \projeto_laravel\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedoresRequest $request, $id)
    {
        //

	  Fornecedor::find($id)->update($request->all());
		return redirect()
					->route('fornecedor.index')
					->withInput(Request::only('nome'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \projeto_laravel\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
			$fornecedor = Fornecedor::find($id);
			$fornecedor->delete();
			return redirect()
					->route('fornecedor.index');
					
    }
}
