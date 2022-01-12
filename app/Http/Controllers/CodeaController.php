<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use DB;
class CodeaController extends Controller
{
    public function index(){
        $img = DB::table('posts')->get();
        return view('welcome', ['img' => $img]);
    }
    public function codeaguardar(Request $request){
        $post = new Post();
        $post->nombre = $request->nombre;
        // script para subir la imagen
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta = public_path("img\post\\");

            copy($imagen->getRealPath(),$ruta.$nombreimagen);
            $post->x = 0;
            $post->y = 0;
            $post->imagen = $nombreimagen;            
            
        }
        $post->save();
        $img = DB::table('posts')->get();
        return view('welcome', ['img' => $img]);
        
    }

    public function update()
    {
        var_dump($_POST);
        Post::where('id', $_POST["id"])
                ->update(['x' => $_POST["x"],'y' => $_POST["y"]]);
    }

}
