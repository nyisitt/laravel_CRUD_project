@extends('main')
@section('contact')
<div class="container">
    <div class="row mt-5">
        <div class="col-6 bg-success m-auto rounded text-white mb-3">

           <div class="d-flex justify-content-between">
            <h3 class="my-3 text-dark">{{$post[0]['title']}}</h3>
            <h4 class="my-3 text-dark">{{$post[0]['created_at']->format('d/F/Y')}}</h4>
           </div>



           <div class="">
            @if ($post[0]['image']== null)
            <img src="{{asset("storage/img not found.png")}}" class=" img-thumbnail img-fluid ">
            @else
            <img src="{{asset("storage/".$post[0]['image'])}}" class=" img-thumbnail img-fluid ">
            @endif
           </div>
           
           <p class=" text-white">{{$post['0']['description']}}</p>

            <div class="text-start my-3 mx-1">
                <span><small class="btn btn-dark text-white mx-1"><i class='bx bx-dollar-circle text-primary'></i>{{$post[0]['price']}}</small></span>
                <span><small class="btn btn-dark text-white mx-1"><i class='bx bx-map text-danger'></i>{{$post[0]['address']}}</small></span>
                <span><small class="btn btn-dark text-white mx-1"><i class='bx bxs-star text-warning' ></i>{{$post[0]['rate']}}</small></span>
             </div>

            <a href="{{route('create')}}" class="btn btn-secondary my-2 "><i class='bx bx-chevrons-left'></i>Back</a>

            <a href="{{route('post#edit',$post[0]['id'])}}" class="btn btn-dark my-2 float-end"><i class='bx bx-edit-alt'></i>Edit</a>
        </div>
    </div>
</div>

@endsection

