@if(session('Mensaje'))
<div class="alert alert-success">
    {{session('Mensaje')}}
</div>
@endif