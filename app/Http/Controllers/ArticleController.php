<?php
namespace App\Http\Controllers;  

use App\Models\Article;  
use App\Models\Artikel;
use App\Models\Category;  
use App\Models\Tag;  
use Illuminate\Http\Request;  

class ArticleController extends Controller  
{  
    /**  
     * Display a listing of the resource.  
     */  
    public function index()  
    {  
        $articles = Artikel::with('category', 'tags')->get();  
        return view('articles.index', compact('articles'));  
    }  

    /**  
     * Show the form for creating a new resource.  
     */  
    public function create()  
    {  
        $categories = Category::all();  
        $tags = Tag::all();  
        return view('articles.create', compact('categories', 'tags'));  
    }  

    /**  
     * Store a newly created resource in storage.  
     */  
    public function store(Request $request)  
{  
    // Validasi input  
    $request->validate([  
        'title' => 'required|string|max:255',  
        'full_text' => 'required|string',  
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  
        'category_id' => 'required|exists:categories,id',  
    ]);  

    // Menyimpan artikel baru  
    $artikel = new Artikel();  
    $artikel->title = $request->title;  
    $artikel->full_text = $request->full_text;  
    $artikel->image = $request->file('image')->store('images', 'public'); // Simpan gambar  
    $artikel->user_id = auth()->id(); // Ambil ID pengguna yang sedang login  
    $artikel->category_id = $request->category_id;  
    $artikel->save();  

    return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');  
    }  

    /**  
     * Display the specified resource.  
     */  
    public function show(Artikel $article)  
    {  
        return view('articles.show', compact('article'));  
    }  

    /**  
     * Show the form for editing the specified resource.  
     */  
    public function edit(Artikel $article)  
    {  
        $categories = Category::all();  
        $tags = Tag::all();  
        return view('articles.edit', compact('article', 'categories', 'tags'));  
    }  

    /**  
     * Update the specified resource in storage.  
     */  
    public function update(Request $request, Artikel $article)  
    {  
        $request->validate([  
            'title' => 'required|string|max:255',  
            'full_text' => 'required|string',  
            'image' => 'nullable|image',  
            'category_id' => 'required|exists:categories,id',  
            'tags' => 'array',  
            'tags.*' => 'exists:tags,id',  
        ]);  

        $article->update([  
            'title' => $request->title,  
            'full_text' => $request->full_text,  
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : $article->image,  
            'category_id' => $request->category_id,  
        ]);  

        $article->tags()->sync($request->tags);  

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');  
    }  

    /**  
     * Remove the specified resource from storage.  
     */  
    public function destroy(Artikel $article)  
    {  
        $article->tags()->detach();  
        $article->delete();  

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');  
    }  
}