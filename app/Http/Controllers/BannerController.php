<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{

    private $banner;
    private $banners;

    public function __construct()
    {
        $this->banner = new Banner();
        $this->banners = Banner::all()->sortByDesc('created_at');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banners;
        
        return view('listagem.banners', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastrar.banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $banner = $this->banner;
        $banner->titulo = $data['titulo'];
        $banner->posicao = $data['posicao'];
        $banner->ativo = $data['ativo'];
        $banner->usuario_id = Auth::user()->id;
        $banner->imagem = 'temp';
        $banner->save();

        $lastInsert =  DB::table('banners')->orderBy('id','desc')->first();
        $id = $lastInsert->id;
        $this->uploadImage($request, $id);
        
        return redirect()->route('banners.index',  ['banners' => Banner::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$banner = Banner::find($id))
        return redirect()->back();
    
        return view('aviario.noticias.exibe_noticia', [
            'banner' => $banner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = $this->banner->find($id);

        return view('cadastrar.banner', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $banner = $this->banner;
        
        $banner->where(['id'=>$id])->update([
            'titulo' => $data['titulo'],
            'posicao' => $data['posicao'],
            'ativo' => $data['ativo'],
            'usuario_id' => Auth::user()->id,
            ]); 
        
        $this->uploadImage($request, $id);

        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = $this->banner;
        $banner = $banner->destroy($id);

        return($banner)?"Sim":"Não";
    }

    public function uploadImage($request, $id)
    {   
        //dd($request->hasFile('imagem'),  $request->file('imagem'), $request->imagem);
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $extension = $request->imagem->extension();

            $resize = Image::make($request->file('imagem'))->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($extension);

            $nameFile = "{$id}.{$extension}";
            $hash = md5($resize->__toString());
         
            $save = Storage::put("imagens/banners/{$nameFile}", $resize->__toString());
            $banner = $this->banner;
            $banner->where(['id'=>$id])->update([
                'imagem' => $nameFile,
            ]); 

            return;
        }

        return "alisson";
    }
}
