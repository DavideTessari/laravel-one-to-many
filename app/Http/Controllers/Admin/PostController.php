<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validation($request->all());
        $validatedData['slug'] = Str::slug($validatedData['name'], '-');

        $formData = $request->all();

        if ($request->hasFile('cover_image')) {
            $img_path = Storage::disk('public')->put('post_images', $request->file('cover_image'));
            $formData['cover_image'] = $img_path;
        }

        $newPost = new Post();
        $newPost->fill($formData);
        $newPost->save();

        return redirect()->route('admin.posts.show', $newPost->id)->with('message', $newPost->name . ' successfully created.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validation($request->all());
        $validatedData['slug'] = Str::slug($validatedData['name'], '-');

        $post = Post::findOrFail($id);
        $formData = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }

            $img_path = Storage::disk('public')->put('post_images', $request->file('cover_image'));
            $formData['cover_image'] = $img_path;
        }

        $post->update($formData);

        return redirect()->route('admin.posts.show', $post->id)->with('message', $post->name . ' successfully updated.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', $post->name . ' successfully deleted.');
    }

    private function validation($data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|string|min:5|max:50',
                'slug' => 'required|string|max:50',
                'client_name' => 'required|string|max:255',
                'summary' => 'nullable|string',
                'cover_image' => 'nullable|image|max:2048',
            ],
            [
                'name.required' => 'Il campo name è obbligatorio',
                'name.max' => 'Il campo name non può avere più di 50 caratteri',
                'name.min' => 'Il campo name deve avere almeno 5 caratteri',
                'slug.required' => 'Il campo slug è obbligatorio',
                'client_name.max' => 'Il campo client_name non può avere più di 255 caratteri',
                'client_name.required' => 'Il campo client_name è obbligatorio',
                'cover_image.image' => 'Il file deve essere un\'immagine',
                'cover_image.max' => 'L\'immagine non può superare i 2MB',
            ]
        )->validate();
    }
}
