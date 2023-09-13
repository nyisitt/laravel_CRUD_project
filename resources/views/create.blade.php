@extends('./main')
@section('contact')
    <div class="container">
        <div class="row mt-5">
            <div class="col-5 ">

               @if (session('insert'))
               <div class="alert-message">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('insert')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
               @endif

          @if (session('updateinsert'))
               <div class="alert-message">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('updateinsert')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
               @endif


               {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
                <div class="">
                    <form action="{{ route('post#data') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text group m-3">
                            <label for="title">Title</label>
                            <input type="text" name="postTitle" id="title" class=" form-control @error('postTitle') is-invalid @enderror"
                                placeholder="Enter title..." value="{{old('postTitle')}}">

                                @error('postTitle')
                                  <div class="invalid-feedback">
                                    {{$message}}
                                   </div>
                                @enderror
                        </div>

                        <div class="text group m-3 ">
                            <label for="title">Description</label><br>
                            <textarea name="postdescription" id="title" cols="40" rows="10" placeholder="Enter description..."
                                class=" form-control @error('postdescription') is-invalid @enderror" >{{old('postdescription')}}</textarea>
                                @error('postdescription')
                                <div class="invalid-feedback">
                                    {{$message}}
                                   </div>
                            @enderror
                        </div>
                        <div class="m-3">
                            <label for="">Image</label>
                            <input type="file" name="postImage" id="" class="form-control @error('postImage') is-invalid @enderror" value="{{old('postImage')}}" >
                            @error('postImage')
                            <div class="invalid-feedback">
                                {{$message}}
                               </div>
                        @enderror
                        </div>

                        <div class="m-3">
                            <label for="">Fee</label>
                            <input type="text" name="postfee" id="" class="form-control @error('postfee') is-invalid @enderror" " value="{{old('postfee')}}" placeholder="Enter Fee...">
                            @error('postfee')
                            <div class="invalid-feedback">
                                {{$message}}
                               </div>
                        @enderror
                        </div>

                        <div class="m-3">
                            <label for="">Address</label>
                            <input type="text" name="postAddress" id="" class="form-control @error('postAddress') is-invalid @enderror"" value="{{old('postAddress')}}" placeholder="Enter address...">
                            @error('postAddress')
                            <div class="invalid-feedback">
                                {{$message}}
                               </div>
                        @enderror
                        </div>
                        <div class="m-3">
                            <label for="">Range</label>
                            <input type="range" name="postrange" min="0" max="5" class="@error('postrange') is-invalid @enderror">
                            @error('postrange')
                            <div class="invalid-feedback">
                                {{$message}}
                               </div>
                        @enderror
                        </div>

                        <div class="m-3  ">
                            <input type="submit" value="Create" class="btn btn-info w-25 ">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7 ">
              <form action="{{route('create')}}" method="GET">
                <div class=" d-flex justify-content-between">
                    <h3>
                        Total - {{$post->total()}}
                    </h3>
                    <h3 class="d-flex">
                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}">
                        <button class="btn btn-danger" type="submit"><i class='bx bx-search'></i></button>
                    </h3>
                   </div>
              </form>
                <div class="data-container">
                    @if (count($post)!= 0)
                    @foreach ($post as $item)
                        <div class="p-3 bg-success rounded mb-3 text-light">
                           <div class=" d-flex justify-content-between">
                            <h3>{{ $item['title'] }}</h3>
                            <h4>{{$item['created_at']->format('j-F-Y')}}</h4>
                           </div>
                            <p class="muted">{{ Str::words($item['description'], 20, '....') }}</p>
                            <div class="text-end">

     <div class="text-start">
        <span><small><i class='bx bx-dollar-circle text-primary'></i>{{$item['price']}}</small></span>|
        <span><small><i class='bx bx-map text-danger'></i>{{$item['address']}}</small></span>|
        <span><small><i class='bx bxs-star text-warning' ></i>{{$item['rate']}}</small></span>
     </div>

                                {{-- first way delete --}}
                                 <a href="{{route('post#delete',$item['id'])}}"> <button class="btn btn-danger"> <i class='bx bxs-trash '></i>
                                    ဖျက်ရန်</button></a>
                                    {{-- second way delete --}}
                               {{-- <form action="{{route('post#delete',$item['id'])}}" method="post">
                                @csrf
                                @method("delete")
                                <a href="{{route('post#delete',$item['id'])}}"> <button class="btn btn-danger"> <i class='bx bxs-trash '></i>
                                    ဖျက်ရန်</button></a>
                               </form> --}}

                 <a href="{{url('post/update/'.$item['id'])}}"> <button class="btn btn-info">
                    <i class='bx bxs-chevrons-right '></i>အပြည့်အစုံဖတ်ရန်
                </button></a>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <h3 class=" mt-3 text-center text-success">There is not find data.....</h3>
                    @endif

                </div>
                {{$post->appends(request()->query())->links()}}
            </div>

        </div>
    </div>
@endsection
