<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'posts' => Post::count(),
            'categories' => Category::count(),
            'contacts' => Contact::count(),
            'subscribers' => Subscriber::count(),
        ];

        $latestPosts = Post::with('category')->latest()->take(5)->get();
        $latestContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestPosts', 'latestContacts'));
    }
}
