<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index()
    {
        $posts = Books::latest()->get();
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
                'title'     => 'required',
                'author'   => 'required',
                'publisher'     => 'required',
                'publication_date'   => 'required',
                'genre'   => 'required',
                'price'   => 'required',
                'quantity'   => 'required',
            ],
            [
                'title.required' => 'Masukkan title Post !',
                'author.required' => 'Masukkan author Post !',
                'publisher.required' => 'Masukkan publisher Post !',
                'publication_date.required' => 'Masukkan publication_date Post !',
                'genre.required' => 'Masukkan genre Post !',
                'price.required' => 'Masukkan price Post !',
                'quantity.required' => 'Masukkan quantity Post !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $post = Books::create([
                'title'     => $request->input('title'),
                'author'   => $request->input('author'),
                'publisher'     => $request->input('publisher'),
                'publication_date'   => $request->input('publication_date'),
                'genre'     => $request->input('genre'),
                'price'   => $request->input('price'),
                'quantity'   => $request->input('quantity')
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
        $post = Books::whereId($id)->first();

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
                'title'     => 'required',
                'author'   => 'required',
                'publisher'     => 'required',
                'publication_date'   => 'required',
                'genre'   => 'required',
                'price'   => 'required',
                'quantity'   => 'required',
            ],
            [
                'title.required' => 'Masukkan title Post !',
                'author.required' => 'Masukkan author Post !',
                'publisher.required' => 'Masukkan publisher Post !',
                'publication_date.required' => 'Masukkan publication_date Post !',
                'genre.required' => 'Masukkan genre Post !',
                'price.required' => 'Masukkan price Post !',
                'quantity.required' => 'Masukkan quantity Post !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $post = Books::whereId($request->input('id'))->update([
                'title'     => $request->input('title'),
                'author'   => $request->input('author'),
                'publisher'     => $request->input('publisher'),
                'publication_date'   => $request->input('publication_date'),
                'genre'     => $request->input('genre'),
                'price'   => $request->input('price'),
                'quantity'     => $request->input('quantity'),
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
        $post = Books::findOrFail($id);
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
