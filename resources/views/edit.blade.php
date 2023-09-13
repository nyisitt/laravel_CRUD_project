@extends('main')
@section('contact')
<div class="container">
    <div class="row mt-5">
        <div class="col-6 bg-success m-auto rounded text-white">
            <a href="{{route('post#update',$edit['id'])}}" class="btn btn-secondary my-2 "><i class='bx bx-chevrons-left'></i>Back</a>


            <form action="{{route('post#real')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="" value="{{$edit['id']}}">
                <label for="title" class="mt-3">Title</label>
                <input type="text" name="postTitle" id="title" class=" form-control @error('postTitle')is-invalid @enderror" placeholder="Enter title..." value="{{old('postTitle',$edit['title'])}}"" >
                @error("postTitle")
                    <div class="invalid-feedback text-warning">
                        {{$message}}
                    </div>
                @enderror

                <label for="" class="mt-3">Image</label>
           <div class="mb-1">
            @if ($edit['image']== null)
            <img src="{{asset("storage/img not found.png")}}" class=" img-thumbnail img-fluid ">
            @else
            <img src="{{asset("storage/".$edit['image'])}}" class=" img-thumbnail img-fluid ">
            @endif
           </div>
           <input type="file" name="postImage" id="" class="form-control @error('postImage') is-invalid @enderror" value="{{old('postImage')}}" >
           @error('postImage')
           <div class="invalid-feedback text-dark">
               {{$message}}
              </div>
       @enderror

                <label for="des" class="mt-3">Description</label>
                <textarea name="postdescription" id="des" cols="30" rows="10" class="form-control @error('postdescription')is-invalid @enderror" placeholder="Enter description...." >{{old('postdescription',$edit['description'])}}</textarea>
                @error('postdescription')
                    <div class="invalid-feedback text-warning">
                        {{$message}}
                    </div>
                @enderror

                <label for="title" class="mt-3">Fee</label>
                <input type="text" name="postfee"  class=" form-control" placeholder="Enter price..." value="{{old('postfee',$edit['price'])}}"" >

                <label for="title" class="mt-3">Address</label>
                <input type="text" name="postAddress" class=" form-control" placeholder="Enter address..." value="{{old('postAddress',$edit['address'])}}"" >

                <label for="title" class="mt-3">Range</label>
                <input type="range" name="postrange" min="0" max="5"  >

                <input type="submit" value="Update" class="btn btn-dark my-3 float-end">
            </form>




        </div>
    </div>
</div>

@endsection
