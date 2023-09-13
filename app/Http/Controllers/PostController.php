<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // create page
    public function create(){
        //  $post = post::orderBy('created_at','desc')->paginate(3);
        // $post =post::select('rate',DB::raw('COUNT(rate) as total_address'),DB::raw('SUM(price) as price'))->groupBy('rate')->get()->toArray();
    //   $posts = post::paginate(5)->through(function($p){
    //   $p->title = strtoupper($p->title);
    //   $p->price = $p->price/2;
    //     return $p;
    //   });
    //    dd($posts->toArray());
    // $data =request('key');
    // $post =post::when(request('key'),function($p){
    //     $search = request('key');
    //     $p->where('title','like','%'.$search.'%');
    // })->get()->toArray();
    // dd($post);


        $post=post::when(request('key'),function($p){
            $key =request('key');
            $p->orWhere('title','like','%'.$key.'%')->orWhere('description','like','%'.$key.'%');
        })->orderBy('created_at','desc')->paginate(3);

        return view('create',compact('post'));
    }
    // Get data
    public function dataInput(Request $request){
        $this->validationCheck($request);
        $data = $this->work($request);

                 if($request->hasFile('postImage')){
            $fileName = uniqid().'-'.$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $data['image']=$fileName;
          };


              post::create($data);
            return redirect()->route('create')->with(['insert'=>"Post ဖန်တီးခြင်း‌အောင်မြင် ပါသည်"]);//route name
    }

    // post delete

    public function postDelete($id){
        // first way
        // post::where('id',$id)->delete();
        // return back();
        // second way
        post::find($id)->delete();
        return back();
    }

    // Post read more
    public function postUpdate($id){

       $post =post::where('id',$id)->get();
        // dd($post->toArray());

        return view('update',compact('post'));
    }

    // post edit

    public function postEdit($id){

       $edit =post::where('id',$id)->first()->toArray();

        return view('edit',compact('edit'));
    }

    // post real update
    public function postRealupdate(Request $request){
        //    dd($request->all());
        $this->validationCheck($request);
       $update = $this->work($request);

       if($request->hasFile('postImage')){
        // old image delete
        $oldimageName = post::select('image')->where('id',$request->id)->first()->toArray();
        $oldName =$oldimageName['image'];
     if($oldName != null){
        Storage::delete('public/'.$oldName);
     }

        // image update
        $fileName = uniqid().'-'.$request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->storeAs('public',$fileName);
        $update['image']=$fileName;
      };

    //    dd($update);
       $id = $request['id'];


     post::where('id',$id)->update($update);
        return redirect()->route('create')->with(['updateinsert'=>"Update လုပ်ခြင်း‌အောင်မြင် ပါသည်"]);


    }
    // private function
    private function work($req){
        // dd($req->all());
        $data=[
            'title' => $req->postTitle,
            'description' => $req->postdescription,
        ];
       $data['price']=$req->postfee == null?2000 : $req->postfee;
       $data['address']=$req->postAddress == null?  "Chauk" : $req->postAddress;
       $data['rate']=$req->postrange == null? 2 : $req->postrange;
        return $data;



    }
    // Valitation Checkfunction
    private function validationCheck($request){
        $validationRule = [
            'postTitle'=>'required|min:3|unique:posts,title,'.$request['id'],
            'postdescription'=>'required',
            //  'postfee'=>'required',
            //  'postAddress'=>'required',
            //  'postrange'=>'required',
            'postImage'=>'mimes:jpg,jpeg,png'
        ];

        $validationMessage =[
            'postTitle.required'=>'Title ဖြည့် ရန်',
            'postTitle.min'=>'At least 3',
            'postTitle.unique'=>'post ခေါင်းစဉ်တူလို့မရပါ',
            'postdescription.required'=>'description ဖြည့်ရန်',
            'postfee.required'=>'Fee ဖြည့် ရန်',
            'postAddress.required'=>'Address ဖြည့် ရန်',
            'postrange.required'=>'range ဖြည့် ရန်',
            'postImage.mimes'=>'jpg,png filesများသာဖြစ်ရပါမည် '

        ];

        Validator::make($request->all(),  $validationRule,$validationMessage)->validate();
    }
}
