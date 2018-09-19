<?php

namespace App\Http\Controllers;

use App\Celula;
use Illuminate\Http\Request;

class CelulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }


    public function index()
    {
        //
        //$celulas = Celula::all();
        //$celulas = Celula::orderby('id','desc')->get();
        $celulas = Celula::orderby('id','desc')->paginate(2);
        return view('celulas.index',['celulas'=>$celulas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('celulas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        print_r($request->input('codigo'));
        print_r($request->codigo);
        print_r($request->nome);
        //echo $request
        */
        /*    
        $this->validate($request, 
            [
                'codigo'=>'required|max:3',
                'nome'=>'required|min:1|max:191',
                'endereco'=>'required|max:191'   
            ]    
        );
        */    
        
        $request->validate([
                'codigo'=>'required',
                'nome'=>'required',
                'endereco'=>'required'   
            ]);
                

        //return $request->nome;
        //return $request->input('nome');
                
        
        Celula::create([
            'codigo'=>$request->codigo,
            'nome'=>$request->nome,
            'endereco'=>$request->endereco,
            'ativa'=>$request->ativa    
            ]);
        
        
        return redirect(route('celulas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Celula  $celula
     * @return \Illuminate\Http\Response
     */
    public function show(Celula $celula)
    {
        //
       
        //return $celula;
        /*
        $celula = Celula::find($celula);
        return $celula;
        */
        return view('celulas.show',['celula'=>$celula]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Celula  $celula
     * @return \Illuminate\Http\Response
     */
    public function edit(Celula $celula)
    {
        //
        //return $celula;
        return view('celulas.edit',compact('celula'));
        //return view('celulas.edit',['celula'=>$celula]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Celula  $celula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Celula $celula)
    {
        $request->validate([
                'codigo'=>'required',
                'nome'=>'required',
                'endereco'=>'required'   
        ]);

        $celula->codigo = $request->codigo;
        $celula->nome = $request->nome;
        $celula->endereco = $request->endereco; 
        $celula->save(); 
        session()->flash('message','Célula atualizada corretamente');
        //return redirect(route('celulas.index'));  
        return redirect()->back();  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Celula  $celula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Celula $celula)
    {
        //
        $celula->delete();
        return redirect(route('celulas.index'));    
    }
}
