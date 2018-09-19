<?php

namespace App\Http\Controllers;

use App\MembrosCelula;
use App\Celula;
use DB;
//use Exception;
use PDOException;
use Illuminate\Http\Request;
ini_set('memory_limit','512M');
class MembrosCelulaController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$membros = MembrosCelula::orderby('id','desc')->paginate(2);
        

        /*$membros = DB::table('membros_celulas')
                    ->select('membros_celulas.id','membros_celulas.nome','membros_celulas.cpf','membros_celulas.celula_id','celulas.nome as nome_celula')
                    ->join('celulas', function ($join) {
                    $join->on('celulas.id', '=', 'membros_celulas.celula_id');
                })->paginate(2);*/

        $membros = MembrosCelula::with(['celula'])->paginate(2);
        //$membros = MembrosCelula::find(11)->celula()->paginate(2);
        //$membros = Celula::find(2)->membrosCelula()->paginate(2);
        //return $membros;                
        return view('membros_celula.index',['membros'=>$membros]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->all());
        //
        //return $celula_id;
        if($request->celula_id) {
            $celula = Celula::find($request->celula_id);
            //print_r($celula);
            //exit;
            return view('membros_celula.create',['celula'=>$celula]); 
        }else{
            $celulas = Celula::all();
            return view('membros_celula.create',['celulas'=>$celulas]);     
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->input('celula_id'));
        //print_r($request->celula_id);
        //exit;

        $request->validate([
                'cpf'=>'required|unique:membros_celulas',
                'email'=>'required',
                'nome'=>'required',
                'endereco'=>'required',
                'celula_id'=>'required'   
            ]);
                
        
        MembrosCelula::create([
            'cpf'=>$request->cpf,
            'email'=>$request->email,
            'nome'=>$request->nome,
            'endereco'=>$request->endereco,
            'celula_id'=>$request->celula_id    
            ]);
        
        
        return redirect(route('membros.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembroCelula  $membroCelula
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //print_r($celula_id);
        //exit;
        //
        
        //dd($request->all());

        $celula = Celula::find($request->celula_id);

        //print_r($celula->nome);
        $membros = $celula->membrosCelula()->paginate(2);
        //$membros = Celula::find($celula_id);
        //print_r($membros);
        //exit;
        
        return view('membros_celula.index',['membros'=>$membros, 'celula'=>$celula]);    
    }

    public function showDaCelula(Request $request)
    {
        //print_r($request->celula_id);
        //exit;
        //
        
        //dd($request->all());
        //if($request->has('celula_id')) {
        if($request->celula_id) {
            $celula = Celula::find($request->celula_id);

            //print_r($celula->nome);
            $membros = $celula->membrosCelula()->paginate(2);
            //$membros = Celula::find($celula_id);
            //print_r($membros);
            //exit;
        }else{
            //mensagem de erro;
        }        
        return view('membros_celula.index',['membros'=>$membros, 'celula'=>$celula]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembroCelula  $membroCelula
     * @return \Illuminate\Http\Response
     */
    public function edit(/*MembrosCelula $membrosCelula*/ $membrosCelula_id)
    {
        //
        $membros = MembrosCelula::find($membrosCelula_id);
        $celulas = Celula::all();
        return view('membros_celula.edit',['membros'=>$membros,'celulas'=>$celulas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembroCelula  $membroCelula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $membrosCelula_id)
    {
        
        $request->validate([
                'cpf'=>'required',
                'email'=>'required',
                'nome'=>'required',
                'endereco'=>'required',
                'celula_id'=>'required'   
            ]);
        //dd($membrosCelula_id);
        try{
            $membros = MembrosCelula::find($membrosCelula_id);

            if($membros->cpf != $request->cpf)
                $membros->cpf = $request->cpf;

            $membros->email = $request->email;
            $membros->nome = $request->nome;
            $membros->endereco = $request->endereco; 
            $membros->celula_id = $request->celula_id; 
            $membros->save(); 
            session()->flash('message','Membro atualizado corretamente.');
            //return redirect(route('membros.index'));  
        }catch(PDOException $e){
            session()->flash('erro','UPS!. Erro ao atualizar. O CPF pode estar repetido.');
        }
        return redirect()->back();
        
       //return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembroCelula  $membroCelula
     * @return \Illuminate\Http\Response
     */
    public function destroy(/* MembrosCelula $membrosCelula*/ $membrosCelula_id, Request $request)
    {
        //
        //$membrosCelula->delete();
        //$membrosCelula = MembrosCelula::all();//('$membrosCelula_id');
        $membrosCelula = MembrosCelula::find($membrosCelula_id)->delete();
        //dd($request->celula_id);
        if(isset($request->celula_id)){
            return redirect(route('membros.show_da_celula', $request->celula_id));    
        }else{
            return redirect(route('membros.index'));    
        }
        
    }
}
