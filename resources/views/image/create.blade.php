@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Subir nueva imagen</div>
                    <div class="card-body">
                        <form action="{{route('image.save')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right" >Imagen</label>
                                <div class="col-md-7">
                                    <input type="file" name="image_path" id="image_path" class="form-control" required="required">
                                    @if($errors->has('image_path'))
                                        <span class="alert-feedback" role="alert">
                                            <strong>
                                                {{$errors->first('image_path')}}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-7">
                                    <textarea name="description" id="description" class="form-control" required="required"></textarea>
                                    @if($errors->has('description'))
                                        <span class="alert-feedback" role="alert">
                                            <strong>
                                                {{$errors->first('description')}}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                               
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" class="btn btn-primary" value="Subir imagen">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
