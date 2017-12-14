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
		$user_id = $this->getUserId();
		$fornecedores = Fornecedor::where('user_id',$user_id)->get();
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

			$user_id = $this->getUserId();

			$usuario = array('user_id'=>$user_id);

			$params2 = array_merge($params,$usuario);

			Fornecedor::create($params2);
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
	

    public function show($id)
    {
  	
		$fornecedor = Fornecedor::find($id);

		$user_id = $this->getUserId();

			if($fornecedor->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
				return view('fornecedor.fornecedor_mostra')->with('fornecedor',$fornecedor);
		  }
			
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
		$user_id = $this->getUserId();
			
				if($fornecedor->user_id != $user_id){
					return  view('erro_de_acesso');
				}else{
					return view('fornecedor.fornecedor_editar')->with('f', $fornecedor);
		
		  }
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
		$user_id = $this->getUserId();
		$fornecedor = Fornecedor::find($id);
	
			if($fornecedor->user_id != $user_id){
				return  view('erro_de_acesso');
			}else{
				Fornecedor::find($id)->update($request->all());
					return redirect()
						->route('fornecedor.index')
						->withInput(Request::only('nome'));
			}


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \projeto_laravel\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
			$user_id = $this->getUserId();

			$fornecedor = Fornecedor::find($id);
			$f_nome = $fornecedor->nome;
		
		if($fornecedor->user_id != $user_id){
			return  view('erro_de_acesso');
		}else{
			$fornecedor->delete();
			return redirect()
					->route('fornecedor.index')->with('fornecedor_nome', $f_nome);
					
    }
	}      //

}
