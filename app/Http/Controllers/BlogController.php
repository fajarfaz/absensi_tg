<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Tampilkan semua artikel
    public function index(Request $request)
    {
        $title = "Daftar Berita dan Artikel";
        $query = Blog::query();

        // Fitur pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Ambil data blog dengan pagination
        $blogs = $query->latest()->paginate(10); // Anda bisa menyesuaikan jumlah item per halaman jika perlu
        return view('blog.index', compact('blogs', 'title'));
    }

    // Tampilkan form untuk membuat artikel baru
    public function create()
    {
        $title = "Tambah Berita dan Artikel";

        return view('blog.create', compact('title'));
    }

    // Simpan artikel baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cta_title' => 'nullable|array',
            'cta_link' => 'nullable|array',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        if ($request->cta_title && $request->cta_link) {

            $ctaArray = [];
            foreach ($request->cta_title as $index => $title) {
                if (!empty($title) && !empty($request->cta_link[$index])) {
                    $ctaArray[] = [
                        'title' => $title,
                        'link' => $request->cta_link[$index],
                    ];
                }
            }
            $blog->call_to_action = json_encode($ctaArray);
        } else {
            $blog->call_to_action = json_encode([]);
        }
        $blog->call_to_action = $blog->call_to_action;
        // var_dump($blog->call_to_action);die;
        $blog->is_published = $request->has('is_published');

        // Proses upload gambar banner
        if ($request->hasFile('banner_image')) {
            $imagePath = $request->file('banner_image')->store('blog_banners');
            $blog->banner_image = $imagePath;
        }

        $blog->save();

        return redirect('/blog')->with('success', 'Blog created successfully.');
    }

    // Tampilkan form edit artikel
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $title = "Edit ". $blog->title;
        return view('blog.edit', compact('blog', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cta_title' => 'nullable|array',
            'cta_link' => 'nullable|array',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        // Generate the slug for the blog
        $slug = Str::slug($request->title);
        $originalSlug = $slug;

        // Check for duplicate slugs
        if ($slug !== $blog->slug) {
            $count = 1;
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle the banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete the old image if it exists
            if ($blog->banner_image) {
                Storage::delete('public/' . $blog->banner_image);
            }

            // Store the new image
            $path = $request->file('banner_image')->store('blog_banners');
        } else {
            // Keep the old image path if no new image is uploaded
            $path = $blog->banner_image;
        }

        // Handle Call to Action
        if ($request->cta_title && $request->cta_link) {
            $ctaArray = [];
            foreach ($request->cta_title as $index => $title) {
                if (!empty($title) && !empty($request->cta_link[$index])) {
                    $ctaArray[] = [
                        'title' => $title,
                        'link' => $request->cta_link[$index],
                    ];
                }
            }
            $blog->call_to_action = json_encode($ctaArray);
        } else {
            $blog->call_to_action = json_encode([]); // Reset to empty if no CTAs are provided
        }

        // Update the blog post including call_to_action
        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'call_to_action' => $blog->call_to_action, // Include call_to_action here
            'is_published' => $request->has('is_published') ? 1 : 0,
            'banner_image' => $path,
        ]);

        return redirect('/blog')->with('success', 'Blog updated successfully.');
    }


    // Hapus artikel dari database
    public function destroy($id)
    {
        // Temukan blog berdasarkan ID
        $blog = Blog::findOrFail($id);
        if ($blog->banner_image) {
            Storage::delete('public/blog_banners/' . $blog->banner_image);
        }

        $blog->delete();

        return redirect('/blog')->with('success', 'Blog deleted successfully.');
    }
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $title = $blog->title;

        return view('blog.show', compact('blog','title'));
    }
    public function listuser(Request $request)
    {
        $title = 'All News';

        $search = $request->input('search');

        $blog = Blog::when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            })
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('blog.list', compact('blog','title'));
    }
}

