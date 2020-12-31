<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function random($count){
        $blog= Blog::select('*')
            ->inRandomOrder()
            ->limit($count)
            ->get();

    $data['blogs']=$blog;

    return response()->json([
        'response_code'=>'00',
        'response_message'=>'data campaigns berhasil ditampilkan',
        'data'=>$data,
    ],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'imgae'=>'required|mimes:jpg,jpeg,png'
        ]);

        $campaign=Campaign::create([
            'title'=>$request->title,
            'description'=>$request->description
        ]);

        if($request->hasFile('image')){

            $image= $request->file('image');
            $image_extension=$image->getClientOriginalExtension();
            $image_name=$campaign->id.".".$image_extension;
            $image_folder='/photos/blog/';
            $image_location=$image_folder.$image_name;

            try {
                $image->move(public_path($image_folder),$image_name);
                $campaign->update([
                    'image'=>$image_location
                ]);
            } catch (\Exception $th) {
                return response()->json([
                    'response_code'=>'01',
                    'response_message'=> 'photo profile user gagal di upload',
                    
                ],200);
            }
        }

        $data['blog']=$blog;

        return response()->json([
            'response_code'=>'00',
            'response_message'=> 'data campaign  berhasil di update',
            'data'=>$data,
        ],200);
    }
}
