<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //RETORNA OS 2 REGISTROS EM ORDEM DESCRESCENTE 
        //$posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->orderBy('title', 'desc')->take(2)->get();
        // foreach($posts as $post){
        //     echo "<h1>{$post->title}</h1>";
        //     echo "<h2>{$post->subtitle}</h2>";
        //     echo "<p>{$post->description}</p>";
        //     echo "<hr";
        // }

         //TRAS O 1 REGISTRO OU MOSTRA PAGINA 404
        // $post = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->firstOrFail();
        // echo "<h1>{$post->title}</h1>";
        // echo "<h2>{$post->subtitle}</h2>";
        // echo "<p>{$post->description}</p>";
        // echo "<hr";

        //RETORNA APENAS O PRIMEIRO REGISTRO ENCONTRADO
        // $post = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->first();
        // echo "<h1>{$post->title}</h1>";
        // echo "<h2>{$post->subtitle}</h2>";
        // echo "<p>{$post->description}</p>";
        // echo "<hr";

        //RETONA O ID INFORMADO
        //$post = Post::find(1);
        // echo "<h1>{$post->title}</h1>";
        // echo "<h2>{$post->subtitle}</h2>";
        // echo "<p>{$post->description}</p>";
        // echo "<hr";

        //VERIFICA SE EXISTE
        //$posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->orderBy('title', 'desc')->exists;

        //QUANTOS REGISTROS TEM DE ACORDO COM A CONSULTA
        //$posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->orderBy('title', 'desc')->count();

        //Maior string da coluna
        //$posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->orderBy('title', 'desc')->max('coluna');
    
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // 4 Modalidade de insercao:
        
        // 1 - Object -> Prop -> Save
        //  1-> faz a instancia, 2-prepara as propriedades, 3-chama metodo save e salva
        $post = new Post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->description = $request->description;
        $post->save();

        // 2 -> Mass assigment (Preenchimento em massa )
        // Post::create([
        //     'title' => $request->title,
        //     'subtitle' => $request->subtitle,
        //     'description' => $request->description
        // ]);

        // 3 -> First Or New o primeiro array informado funciona como um WHERE ele vai tentar
        // verificar no banco de dados se ja existe algum artigo na coluna title com o valor que tamos passando em "$request->title"
        // caso existe ele nao cria o registro na base de dados, basicamente o 1 arraye uma condicao.
        // $post = Post::firstOrNew([
        //     'title' => 'teste2',
        //     'subtitle' => 'teste3',
        // ],[
        //     'description' => 'teste2'
        // ]);
        // $post->save();

        // 4 -> First Or Create nao e necessario invovar o metodo save
        // $post = Post::firstOrCreate([
        //     'title' => 'teste4',
        //     'subtitle' => 'teste4',
        // ],[
        //     'description' => 'teste4'
        // ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post){

        //Para atualizar um registro podemos ir direto sem fazer a instancia de um novo obeto
        // $post->title = $request->title;
        // $post->subtitle = $request->subtitle;
        // $post->description = $request->description;
        // $post->save();

        //Tambem podemos atualiazar informando o ID
        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->description = $request->description;
        $post->save();

        //Atualiza se existir se nao ele cria
        // $post = Post::updateOrCreate([
        //     'title' => 'teste5'
        // ],[
        //     'subtitle' => 'teste5',
        //     'description' => 'teste5 '
        // ]);

        //Faxendo atualizacao em massa
        //Post::where('created_at', '>=', date('Y-m-d H:i:s'))->update(['description' => 'teste']);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post){
        
        //1 - Case DELETE USANDO FIND
        //Post::find($post->id)->delete();        

        //2 - Case DELTE USANDO DESTROY
        //Post::destroy([2, 3])

        //3 - Case USANDO DELETE COM OBJETO  <--- MAIS USADO NO DIA A DIA
        Post::destroy($post->id);

        //4 - DELECAO EM MASSA
        //Post::where('created_at', '>=', date('Y-m-d H:i:s'))->delete();
        return redirect()->route('posts.index');
    }
}
