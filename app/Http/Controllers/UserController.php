<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;



class UserController extends Controller
{
    
    //
    public function config()
    {
        return view('user.config');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function update(Request $Request){
        
        $user = \Auth::user();
        $id = $user->id;
        $name = $Request->input('name');
        $surname = $Request->input('surname');
        $nick = $Request->input('nick');
        $email = $Request->input('email');

        $validate = $this->validate($Request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255','unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
            
        ]);
        $user->name=$name;
        $user->surname=$surname;
        $user->nick=$nick;
        $user->email=$email;

        //Subir la imagen
        $imagen_path = $Request->file('image_path');
        if($imagen_path){
            $image_path_name = time().$imagen_path->getClientOriginalName();
            Storage::disk('users')->put($image_path_name,File::get($imagen_path));
            $user->image = $image_path_name;
        }
       

        $user->update();
      
        return redirect()->route('config')
                         ->with(['Mensaje'=>'Valor actualizado correctamente']);
        

    }
    public function getImagen($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }
}
