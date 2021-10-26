<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::resourceVerbs([
  'create' => 'cadastro',
  'edit' => 'editar'
]);

Route::get('/', function () {
    return view('welcome');
});

//Route::view('/form', 'form');

/*
Route::verbo('URI', 'Controller@metodo');

GET: Utilizados para obter dados so servidor e nao altera o estado do recurso.
  Quando um formulario GET e Disparado, os dados ficamna URL.

  Route::get($uri, $callback);


POST: Utilizado para criacao de Recurso ou envio de dados ao Servidor para validacao.
  Os dados ficam no corpo da requisicao e nao na URL.

  Route::post($uri, $callback);


PUT: Utilizado para atualizacao de recurso. O caminho da requisicao deve conter o objeto a ser atualizado
  juntamente com todos os parametros do objeto para que possa ser feita a acao com sucesso.
  deve-se usar o Form Method Spoofing (Falsificacao de Verbo) [@method('PUT')]

  Route::put($uri, $callback);


PATH: Utilizado para atualizao parcial do recurso. tem o mesmo funcionamento no PUT.
  Tambem trabalha com Form Method Spoofing (Falsificacao do Verbo) [@method('PATCH')]

  Route::patch($uri, $callback);



DELETE: Utilizado para Excluir um recurso especifico atraves de um parametro informado.
  Route::delete($uri, $callback);


OPTIONS: Uma forma de voce verificar os metodos aceitos em um determinada request, metodos
  pouco utilizado.

  Route::options($uri, $callback);

RESOURCE: Utilizado para criar um todos os metodos de uma so vez, podemos informar metodos,
  especiais "only" para criar apenas metodos especificos e "except" para nao criar metodos especificos

  Route::resource('/posts', 'postController')->only(['index', 'show']);
  Route::resource('/posts', 'postController')->except(['destroy']);



Passo a passo: Definir rota -> Criar controllador -> Criacao de metodo -> Camada View

  php artisan route:list                                    (PARA EXIBIR AS ROTAS)

  php artisan make:controller postController --resource     (PARA CRIAR UM CONTROLE COM TODOS OS METODOS)

  php artisan make:controller API\\UserController --api     (PARA CRIAR UM API CONTROLLER COM TODOS OS METODOS)

*/


//================================== ROUTES ==================================
//GET
// Route::get('/users/1', 'UserController@index');
// Route::get('/getData', 'UserController@getData');


//POST
// Route::post('/postData', 'UserController@postData');



//PUT
// Route::put('/users/1', 'UserController@testPut');

//PATCH
// Route::patch('/users/1', 'UserController@testPatch');


//MATCH
// Route::match(['put', 'patch'], '/users/2', 'UserController@testMatch');


//DELETE
// Route::delete('/users/1', 'UserController@destroy');


//ANY
// Route::any('/users', 'UserController@any');


//AO DECLARAR UM ROTA ESPECIFICA ANTES DO RESOURCE ELE SERA SOBRESCRITA PORQUE O PHP
//E LIDO DE CIMA PRA BAIXO
// Route::get('/posts/premium', 'postController@premium');


//RESOURCE CRIA UM CRUD COMPLETO AO PASSAR "ONLY" INFORMAMOS QUE QUEREMOS APENAS AQUELES
//METODOS NO CONTROLADOR
//Route::resource('/posts', 'postController')->only(['index', 'show']);


//RESOURCE CRIA UM CRUD COMPLETO AO PASSAR "EXCEPT" INFORMAMOS QUE NAO QUEREMOS AQUELES
//METODOS NO CONTROLADOR
//Route::resource('/posts', 'postController')->except(['destroy']);

// TRABALHANDO COM CLOSURE O CACHEAMENTO NAO FUNCIONA E PERDMOS PERFOMACE
//ESTA NAO E UMA FORMA RECOMENDADA DE SE TRABALHAR, TRABALHE SEMPRE COM CONTROLADOR @ METODO

  // Route::get('/users', function(){
  //   echo " Listagem dos usuarios da minha base";
  // });


//SOMENTE USAMOS ESTA MANEIRA QUANDO PRECISAMOS RETORNA UMA PAGINA SEM ACAO NENHUMA DO USUARIO
  // Route::view('/form', 'form');


//ESTA CHAMADA(FALLBACK) E UMA PAGINA 404 NAO ENCONTRADA A MELHOR FORMA E TER UM CONTROLADOR 
  // Route::fallback(function(){
  //   echo "<h1>Seja bem vido a pagina 404 nada encontrado por aqui </h1>";
  // });


//USADO PARA REDIRECIONAR 1 QUAL A ORIGEM, 2 PRA ONDE DEVE IR, 3 QUAL O CODIGO HTTP
  // Route::redirect('/users/add', url('/form'), 301);


//USANDO NAMES PARA AS ROTAS PODEMOS ALTERAR A URL SEM QUE SOFRAMOS COM UMA MANUNCAO ARDUA
//DESTA FORMA UMA COISA FICA DESACOMPLADA DA OUTRA NO CONTROLADOR PASSAREMOS O NAME.
  // Route::get('/artigos','PostController@index')->name("post.index");
  // Route::get('/artigos/index','PostController@indexRedirect')->name("post.indexRedirect");


//SEMPRE TRABALHE COM METODOS PARA FINS DE APRENDER RAPIDAMENTE ESTAMOS USANDO CLOUSURE
//MAS O CORRETO E CONTROLLER @ METODO
// COMO TRABALHAR COM PARAMETROS VIA URL E VALIDACAO ADEQUADA
  // Route::get('/users/{id}/comments/{comment?}', function($id,$commet = null){
  //   var_dump($id, $commet);
  // })->where('id', '[0-9]+');


  // Route::get('/users/{id}/comments/{comment?}', function($id,$commet = null){
  //   var_dump($id, $commet);
  // })->where([ 'id' => '[0-9]+', 'comment' => '[a-zA-Z0-9]+' ]);


  //Route::get('/users/{id}/comments/{comment?}', 'UserController@userComments')->where([ 'id' => '[0-9]+', 'comment' => '[a-zA-Z0-9]+' ]);

//COMO IDENTIFICAR A ROTA ATUAL QUE ESTAMO O NOME DELA E ACAO DELA
// Route::get('/users/1', 'UserController@inspect')->name('inspect');


//AGRUPAMENTO USANDO PREFIXO
  Route::prefix('admin')->group(function(){
    Route::view('/form', 'form');
  });


//DE ALGUMA FORMA SE LIGA AO PREFIXO
Route::name('admin.post.')->group(function(){
  Route::get('/admin/posts/index', 'PostController@index')->name('index');
  Route::get('/admin/post', 'PostController@show')->name('show');
});


//AGRUPAMENTO POR MIDDLEWARE
Route::middleware((['throtlle:10,1']))->group(function(){
  Route::view('/form', 'form');
});


//AGRUPAMENTO POR NAMESPACE
Route::namespace('Admin')->group(function(){
  Route::get('/users', 'UserController@index');
});


//AGRUPAMENTO ATRAVES DE PREFIXO, NAME, MIDDLEWARE, NAMESPACE
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware'  => ['throtlle:10,1'], 'as' => 'admin.'],function(){
  Route::resource('users', 'UserController');
});