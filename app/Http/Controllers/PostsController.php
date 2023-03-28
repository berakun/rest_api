<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'product_name'     => 'required',
                'color'   => 'required',
                'category'     => 'required',
                'price'   => 'required',
            ],
            [
                'product_name.required' => 'Masukkan Produk Post !',
                'color.required' => 'Masukkan Color Post !',
                'category.required' => 'Masukkan Category Post !',
                'price.required' => 'Masukkan Price Post !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $post = Post::create([
                'product_name'     => $request->input('product_name'),
                'color'   => $request->input('color'),
                'category'     => $request->input('category'),
                'price'   => $request->input('price')
            ]);


            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!',
                ], 400);
            }
        }
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

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'product_name'     => 'required',
                'color'   => 'required',
                'category'     => 'required',
                'price'   => 'required',
            ],
            [
                'product_name.required' => 'Masukkan Produk Post !',
                'color.required' => 'Masukkan Color Post !',
                'category.required' => 'Masukkan Category Post !',
                'price.required' => 'Masukkan Price Post !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $post = Post::whereId($request->input('id'))->update([
                'product_name'     => $request->input('product_name'),
                'color'   => $request->input('color'),
                'category'     => $request->input('category'),
                'price'   => $request->input('price')
            ]);


            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 500);
        }
    }
}
