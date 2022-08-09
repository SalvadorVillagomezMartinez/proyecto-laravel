<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class ControllerComment extends Controller
{
    public function save(Request $request){
        
        $validate = $this->validate($request,[
            'id_user' => ['required', 'integer'],
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string']
        ]);
        
        //Recuperamos
        $id_user = $request->input('id_user');
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        $comment = new Comment();
        $comment->user_id = $id_user;
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save();
        return redirect()->route('image.detail',['id'=>$image_id])
        ->with(['Mensaje'=>'Comentario agregado']);
        

    }
    public function delete($id){
		// Conseguir datos del usuario logueado 
		$user = \Auth::user();
		// Conseguir objeto del comentario
		$comment = Comment::find($id);
		
        //Comprobar si soy el dueño del comentario o de la publicación
		if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
			$comment->delete();
            
			return redirect()->route('image.detail', ['id' => $comment->image->id])
						 ->with([
							'Mensaje' => 'Comentario eliminado correctamente!!'
						 ]);
                            
        }else{
			return redirect()->route('image.detail', ['id' => $comment->image->id])
						 ->with([
							'Mensaje' => 'EL COMENTARIO NO SE HA ELIMINADO!!'
						 ]);
		}
      
        
	}
}
