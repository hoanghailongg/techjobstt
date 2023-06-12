<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.list', [
            'title' => 'Danh sách tin tức',
            'posts' => $this->postService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.add', [
            'title' => 'Thêm mới bài viết',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $this->postService->create($request);
        return redirect()->route('admin.posts.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'title' => 'Chỉnh sửa tin tức',
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $result = $this->postService->update($post, $request);

        if ($result) {
            return redirect()->route('admin.posts.index');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->postService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa bài viết thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
