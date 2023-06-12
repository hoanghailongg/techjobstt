<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class PostService
{

    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    public function get()
    {
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function create($request): bool
    {
        try {

            if ($request->hasFile('thumb')) {
                $path_image = $this->upload->store($request->file('thumb'));
            } else {
                $path_image = '/default/image-available.jpg';
            }

            Post::create([
                "title" => (string)$request->title,
                "description" => (string)$request->description,
                "content" => (string)$request->content,
                "slug" => (string)$request->slug,
                "category" => (string)$request->category,
                "thumb" => $path_image,
            ]);

            Session::flash('success', 'Tạo tin tức thành công.');
        } catch (Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request): bool
    {
        $slug = $request->input('slug');

        $post = Post::where('slug', $slug)->first();

        if ($post) {
            return $post->delete();
        }

        return false;
    }

    public function update($post, $request): bool
    {
        try {

            if ($request->hasFile('thumb')) {
                $post->thumb = $this->upload->store($request->file('thumb'));
            }

            $post->title = (string)$request->title;
            $post->description = (string)$request->description;
            $post->content = (string)$request->content;
            $post->slug = (string)$request->slug;
            $post->category = (string)$request->category;
            $post->save();

            Session::flash('success', 'Cập nhật danh mục thành công.');
            return true;
        } catch (Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }



}
