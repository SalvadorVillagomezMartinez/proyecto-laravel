<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Like;

class LikeController extends Controller
{
    public function like($image_id){
        $user = \Auth::user();

        //Condicion para ver si ya existe el like
        $isset_like = Like::where('user_id',$user->id)->where('image_id',$image_id)->count();
        if($isset_like==0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id=(int) $image_id;
            $like->save();
            return response()->json([ 'like' => $like ]);
         }else{
            return response()->json([ 'Mensaje' => 'El like ya existe' ]);
         }

    }
    public function dislike($image_id){
        $user = \Auth::user();

        //Condicion para ver si ya existe el like
        $like = Like::where('user_id',$user->id)->where('image_id',$image_id)->first();
        if($like){
           $like->delete();
            return response()->json([ 'like' => $like ,
                                     'Mensaje' => 'Has eliminado el like']);
         }else{
            return response()->json([ 'Mensaje' => 'El like no existe' ]);
         }

    }
}
