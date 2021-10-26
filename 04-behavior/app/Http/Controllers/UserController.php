<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
  //GET
  public function index(){
    return "<h1>Listagem de usuario com id 1</h1>";
  }

  public function getData(){
    return "<h1>Disparou Acao de GET visivel no Link</h1>";
  }



  //POST
  public function postData(Request $request){

    var_dump($request);
    return "<h1>Disparou Acao de POST</h1>";
  }



  //PUT
  public function testPut(Request $request){

    echo "<h1>Usuario da edicao e o de codigo 1</h1>";
    var_dump($request);
    return "<h1>Disparou Acao de PUT</h1>";
  }



  //PATCH
  public function testPatch(Request $request){

    echo "<h1>Usuario da edicao e o de codigo 1</h1>";
    echo "<pre> .var_dump($request). </pre>";
    return "<h1>Disparou Acao de PATCH</h1>";
  }



  //PUT or PATCH
  public function testMatch(Request $request){

    echo "<h1>Disparou Acao de PUT/PATCH (MATCH) </h1>";
    echo "<h1>Usuario da edicao e o de codigo 1</h1>";
    return  "<pre> .var_dump($request). </pre>";

  }



  //DELETE
  public function destroy(){
    return "<h1>Disparou Acao de DELETE para o registro 1</h1>";
  }



  //ANY
  public function any(){
    return "<h1>QUALQUER VERBALIZACAO E ACEITA</h1>";
  }

  public function userComments($id, $comment = null){
    echo "Controller: User Metodo: UserComments ";
    var_dump("Id = ".$id. "<br>" ."Comentario = ".$comment);
  }

  public function inspect(){
    $route = Route::current();
    $name = Route::currentRouteName();
    $action = Route::currentRouteAction();
    
    var_dump($route ,$name, $action);
  }
}
