<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $categories = collect([
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'icon' => 'bi-flower1'],
            ['name' => 'Wellness', 'slug' => 'wellness', 'icon' => 'bi-heart-pulse'],
            ['name' => 'Travel', 'slug' => 'travel', 'icon' => 'bi-airplane'],
            ['name' => 'Personal Growth', 'slug' => 'personal-growth', 'icon' => 'bi-book'],
            ['name' => 'Mindfulness', 'slug' => 'mindfulness', 'icon' => 'bi-brightness-alt-high'],
            ['name' => 'Photography', 'slug' => 'photography', 'icon' => 'bi-camera'],
        ])->mapWithKeys(function (array $category) {
            $model = Category::updateOrCreate(['slug' => $category['slug']], $category);

            return [$category['slug'] => $model];
        });

        $posts = [
            [
                'category' => 'lifestyle',
                'title' => '10 Daily Habits That Changed My Life',
                'slug' => '10-daily-habits-that-changed-my-life',
                'short_description' => 'Simple habits, real results. These small intentional changes helped me find balance, purpose, and happiness in everyday life.',
                'content' => "Small habits work because they are easy to repeat. Start with a fixed wake-up time, a glass of water, and five quiet minutes before checking your phone.\n\nPlanning your top three tasks gives the day direction. A short walk, simple meals, and a clean desk help your mind feel lighter.\n\nThe biggest change is consistency. You do not need a perfect routine; you need a routine you can return to after a busy day.",
                'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80',
                'read_time' => 6,
                'is_featured' => true,
                'is_popular' => true,
            ],
            [
                'category' => 'lifestyle',
                'title' => 'Morning Routines for a Productive Day',
                'slug' => 'morning-routines-for-a-productive-day',
                'short_description' => 'Build a calm morning routine that gives your day more energy, clarity, and focus.',
                'content' => "A productive morning starts the night before. Keep your workspace ready, write tomorrow's first task, and sleep at a realistic time.\n\nIn the morning, keep the first hour simple: hydrate, move your body, and review your plan. This makes the day feel less rushed.\n\nYou can adjust the routine as your life changes. The goal is not perfection; the goal is a steady start.",
                'image' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1200&q=80',
                'read_time' => 5,
                'is_featured' => false,
                'is_popular' => true,
            ],
            [
                'category' => 'travel',
                'title' => '10 Breathtaking Places You Must Visit',
                'slug' => '10-breathtaking-places-you-must-visit',
                'short_description' => 'Travel opens your mind, refreshes your soul, and gives you memories that last a lifetime.',
                'content' => "Travel is not only about distance. It is about noticing new colors, listening to new stories, and returning home with a wider view of life.\n\n1. Banff National Park, Canada\nKnown for its lakes, peaks, and peaceful trails, Banff is perfect for nature lovers and photographers.\n\n2. Santorini, Greece\nWhitewashed buildings, blue domes, and unforgettable sunsets make Santorini a classic dream destination.\n\n3. Why these places matter\nThe best destinations create lasting memories and remind us how diverse the world can be.",
                'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1400&q=80',
                'read_time' => 5,
                'is_featured' => false,
                'is_popular' => false,
            ],
            [
                'category' => 'wellness',
                'title' => 'Easy Healthy Recipes You Will Love',
                'slug' => 'easy-healthy-recipes-you-will-love',
                'short_description' => 'Fresh, colorful, beginner-friendly meals that make healthy eating feel simple.',
                'content' => "Healthy food becomes easier when your ingredients are ready. Keep washed greens, cooked grains, and one simple dressing in the fridge.\n\nA balanced bowl can be made with rice, roasted vegetables, chickpeas, and a lemon yogurt sauce. It is quick, filling, and easy to customize.\n\nStart with recipes you already enjoy and make one healthier swap at a time.",
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=1200&q=80',
                'read_time' => 6,
                'is_featured' => false,
                'is_popular' => false,
            ],
            [
                'category' => 'personal-growth',
                'title' => 'How Journaling Transforms Your Mind',
                'slug' => 'how-journaling-transforms-your-mind',
                'short_description' => 'A simple writing habit can help you understand your thoughts and make better decisions.',
                'content' => "Journaling creates a quiet space between your feelings and your choices. You can write what happened, how you felt, and what you want to try next.\n\nUse prompts like: What gave me energy today? What drained me? What one thing can I improve tomorrow?\n\nOver time, your journal becomes a map of patterns, progress, and honest self-awareness.",
                'image' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&w=1200&q=80',
                'read_time' => 4,
                'is_featured' => false,
                'is_popular' => false,
            ],
            [
                'category' => 'mindfulness',
                'title' => 'The Art of Slow Living in a Fast World',
                'slug' => 'the-art-of-slow-living-in-a-fast-world',
                'short_description' => 'Slow living is about choosing attention, boundaries, and presence in ordinary moments.',
                'content' => "Slow living does not mean doing nothing. It means doing fewer things with more care.\n\nStart by creating small pauses: drink tea without your phone, walk without headphones, or leave open space between tasks.\n\nWhen you protect your attention, your days feel less noisy and more meaningful.",
                'image' => 'https://images.unsplash.com/photo-1484101403633-562f891dc89a?auto=format&fit=crop&w=1200&q=80',
                'read_time' => 5,
                'is_featured' => false,
                'is_popular' => true,
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'category_id' => $categories[$post['category']]->id,
                    'title' => $post['title'],
                    'short_description' => $post['short_description'],
                    'content' => $post['content'],
                    'image' => $post['image'],
                    'read_time' => $post['read_time'],
                    'is_featured' => $post['is_featured'],
                    'is_popular' => $post['is_popular'],
                    'status' => 'published',
                ]
            );
        }

        Subscriber::updateOrCreate(['email' => 'reader@example.com']);

        Contact::firstOrCreate(
            ['email' => 'visitor@example.com', 'subject' => 'Collaboration request'],
            [
                'name' => 'Sample Visitor',
                'message' => 'I love the clean blog design and would like to collaborate.',
            ]
        );
    }
}
