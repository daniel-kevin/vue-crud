<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();
        // return response([
        //     'success' => true,
        //     'message' => 'List Semua Posts',
        //     'data' => $posts
        // ], 200);
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //validate data
        // $validator = Validator::make($request->all(), [
        //     'title'     => 'required',
        //     'body'   => 'required',
        // ],
        //     [
        //         'title.required' => 'Masukkan Title Post !',
        //         'body.required' => 'Masukkan body Post !',
        //     ]
        // );

        // if($validator->fails()) {

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Silahkan Isi Bidang Yang Kosong',
        //         'data'    => $validator->errors()
        //     ],400);

        // } else {

        //     $post = Post::create([
        //         'title'     => $request->input('title'),
        //         'body'   => $request->input('body')
        //     ]);


        //     if ($post) {
        //         return response()->json([
        //             'success' => true,
        //             'message' => 'Post Berhasil Disimpan!',
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Post Gagal Disimpan!',
        //         ], 400);
        //     }
        // }
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
   
        Post::create($request->all());
        return redirect()->route('posts.index');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'title'     => 'required',
        //     'body'   => 'required',
        // ],
        //     [
        //         'title.required' => 'Masukkan Title Post !',
        //         'body.required' => 'Masukkan body Post !',
        //     ]
        // );

        // if($validator->fails()) {

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Silahkan Isi Bidang Yang Kosong',
        //         'data'    => $validator->errors()
        //     ],400);

        // } else {

        //     $post = Post::whereId($request->input('id'))->update([
        //         'title'     => $request->input('title'),
        //         'body'   => $request->input('body'),
        //     ]);


        //     if ($post) {
        //         return response()->json([
        //             'success' => true,
        //             'message' => 'Post Berhasil Diupdate!',
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Post Gagal Diupdate!',
        //         ], 500);
        //     }

        // }
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
    
        Post::find($id)->update($request->all());
        return redirect()->route('posts.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $post = Post::findOrFail($id);
        // $post->delete();

        // if ($post) {
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Post Berhasil Dihapus!',
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post Gagal Dihapus!',
        //     ], 500);
        // }
        Post::find($id)->delete();
        return redirect()->route('posts.index');
    }
    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }
}

