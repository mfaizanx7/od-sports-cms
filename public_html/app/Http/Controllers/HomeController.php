<?php

namespace App\Http\Controllers;

use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index(ProductInterface $productRepository)
    {
        $featuredProducts = $productRepository->advancedGet([
            'condition' => [
                'status' => 'published',
                'is_featured' => 1,
            ],
            'take' => 8,
            'with' => ['categories'],
        ]);

        $latestPosts = \Botble\Blog\Models\Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('home.index', compact('featuredProducts', 'latestPosts'));
    }
}