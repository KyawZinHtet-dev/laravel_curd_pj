<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function showPage()
    {
        $dbData = Post::when(request('sKey'), function ($data, $key) {
            $data->orwhere('title', 'like', '%' . $key . '%')->orwhere('description', 'like', '%' . $key . '%');
        })->orderby('created_at', 'desc')->paginate(2);

        Session::put('prevUrl', request()->fullUrl());

        return view('create', compact('dbData'));
    }

    public function createPost(Request $request)
    {
        $this->validationCheck($request);
        $data = $this->getData($request);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '_kZin_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }

        Post::create($data);
        return redirect()->route('postCreate')->with(['successMsg' => 'Post Creating Success!']);
    }

    public function deletePost($id)
    {
        $oldImgName = Post::select('image')->where('id', $id)->first()->toArray();
        $oldImgName = $oldImgName['image'];

        if ($oldImgName != null) {
            Storage::delete('/public/' . $oldImgName);
        }

        Post::where('id', $id)->delete();
        return redirect()->route('postCreate')->with(['deleteMsg' => 'A Post Have Been Deleted!']);
    }

    public function deleteImg($id)
    {
        $data = Post::where('id', $id)->get()->toArray();

        $oldImgName = $data[0]['image'];
        Storage::delete('/public/' . $oldImgName);

        $data = [
            'id' => $data[0]['id'],
            'title' => $data[0]['title'],
            'description' => $data[0]['description'],
            'price' => $data[0]['price'],
            'city' => $data[0]['city'],
            'rating' => $data[0]['rating'],
            'image' => null,
        ];

        Post::where('id', $id)->update($data);

        return redirect()->route('postEdit', $id);
    }

    public function showMore($id)
    {
        $data = Post::where('id', $id)->first();
        return view('post', compact('data'));
    }

    public function editPost($id)
    {
        $data = Post::where('id', $id)->first();
        return view('edit', compact('data'));
    }


    public function updatePost(Request $request, $id)
    {
        $this->validationCheck($request);
        $data = $this->getData($request);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '_kZin_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $data['image'] = $imageName;

            $oldImgName = Post::select('image')->where('id', $id)->first()->toArray();
            $oldImgName = $oldImgName['image'];

            if ($oldImgName != null) {
                Storage::delete('/public/' . $oldImgName);
            }
        }

        Post::where('id', $id)->update($data);
        return redirect()->route('showMore', $id)->with(['updateMsg' => 'Post Updating Success!']);
    }




    private function getData($request)
    {
        $data = $request->all();
        $data = [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'city' => $data['city'],
            'rating' => $data['rating'],
        ];
        return $data;
    }

    private function validationCheck($request)
    {
        $validationRules = [
            'title' => 'required|min:3|max:100|unique:posts,title,' . $request['id'],
            'description' => 'required',
            'price' => 'required',
            'city' => 'required',
            'rating' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ];

        $validationMessage = [
            'title.required' => 'Post Title ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'title.min' => 'Post Title အနည်းဆုံး 3လုံး ရှိရပါမည်။',
            'title.max' => 'Post Title အများဆုံး 100လုံးသာ လက်ခံပါသည်။',
            'title.unique' => 'Post Title ရှိပြီးသားဖြစ်နေပါသည်။ နောက်တစ်ခုနဲ့ ထပ်မံကြိုးစားကြည့်ပါ။',
            'description.required' => 'Post Description ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'price.required' => 'Price ဖြည့်ရန် လိုအပ်ပါသည်။',
            'city.required' => 'City Name ဖြည့်ရန် လိုအပ်ပါသည်။',
            'rating.required' => 'Rating ဖြည့်ရန် လိုအပ်ပါသည်။',
            'image.mimes' => 'Dot(.) နောက်မှ Extention Name သည် jpg, jpeg or png ဖြစ်ရန် လိုအပ်ပါသည်။'
        ];


        Validator::make($request->all(), $validationRules, $validationMessage)->validate();
    }
}
