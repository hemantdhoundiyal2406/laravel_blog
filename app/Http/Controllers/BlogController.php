<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function home(): View
    {
        $featuredPost = Post::published()
            ->with('category')
            ->where('is_featured', true)
            ->latest()
            ->first() ?? Post::published()->with('category')->latest()->first();

        $categories = Category::withCount(['posts' => fn ($query) => $query->published()])
            ->orderBy('name')
            ->take(6)
            ->get();

        $latestPosts = Post::published()
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        $popularPosts = Post::published()
            ->with('category')
            ->where('is_popular', true)
            ->latest()
            ->take(3)
            ->get();

        return view('public.home', compact('featuredPost', 'categories', 'latestPosts', 'popularPosts'));
    }

    public function index(Request $request): View
    {
        $categories = Category::withCount(['posts' => fn ($query) => $query->published()])
            ->orderBy('name')
            ->get();

        $posts = Post::published()
            ->with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($category) => $category->where('slug', $request->category));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('public.blog-index', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        abort_unless($post->status === 'published', 404);

        $post->load('category');

        $relatedPosts = Post::published()
            ->with('category')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $morePosts = Post::published()
                ->with('category')
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->latest()
                ->take(3 - $relatedPosts->count())
                ->get();

            $relatedPosts = $relatedPosts->merge($morePosts);
        }

        $previousPost = Post::published()->where('id', '<', $post->id)->latest('id')->first();
        $nextPost = Post::published()->where('id', '>', $post->id)->oldest('id')->first();

        return view('public.blog-detail', compact('post', 'relatedPosts', 'previousPost', 'nextPost'));
    }

    public function about(): View
    {
        return view('public.about');
    }

    public function contact(): View
    {
        return view('public.contact');
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $contact = Contact::create($data);

        Mail::to(config('mail.admin_address'))->send(new ContactMessageMail($contact));

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscribers,email'],
        ]);

        Subscriber::create($data);

        return back()->with('success', 'You are subscribed successfully.');
    }
}
