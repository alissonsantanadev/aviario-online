<?php

namespace App\Http\Controllers;

use App\Models\EmpresaCategoria;
use Illuminate\Http\Request;

class EmpresaCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = EmpresaCategoria::all();
        return view('listagem.empresa_categorias', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastrar.empresa_categoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => ['required', 'string', 'max:255'],
        ]);
        
        $data = $request->all();

        $categoria = new EmpresaCategoria();
        $categoria->descricao = $data['descricao'];
        $categoria->save();
        
        return redirect()->route('empresa_categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpresaCategoria  $empresaCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(EmpresaCategoria $empresaCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpresaCategoria  $empresaCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = new EmpresaCategoria();
        $categoria = $categoria->find($id);

        return view('cadastrar.empresa_categoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpresaCategoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descricao' => ['required', 'string', 'max:255'],
        ]);
        
        $data = $request->all();
        $categoria = new EmpresaCategoria();
        
        $categoria->where(['id'=>$id])->update([
            'descricao' => $data['descricao']
        ]);

        return redirect()->route('empresa_categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpresaCategoria  $empresaCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = new EmpresaCategoria();
        $categoria = $categoria->destroy($id);

        return($categoria)?"Sim":"Não";
    }
}
