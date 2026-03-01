<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Veg Biryani',
                'description' => 'Aromatic basmati rice cooked with mixed vegetables and traditional spices.',
                'price' => 15.00,
                'category' => 'Main Course',
                'food_type' => 'veg',
                'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
            [
                'name' => 'Chicken Biryani',
                'description' => 'Classic hyderabadi style chicken biryani with tender chicken pieces.',
                'price' => 18.00,
                'category' => 'Main Course',
                'food_type' => 'non-veg',
                'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?q=80&w=600&auto=format&fit=crop', // Placeholder
                'is_available' => true,
            ],
            [
                'name' => 'Pan-Seared Salmon',
                'description' => 'Fresh Atlantic salmon served with asparagus, roasted baby potatos, and a lemon butter sauce.',
                'price' => 28.00,
                'category' => 'Main Course',
                'food_type' => 'non-veg',
                'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a7270028d?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
            [
                'name' => 'Wagyu Beef Burger',
                'description' => 'Premium Wagyu beef patty topped with aged cheddar, caramelized onions, and truffle aioli on a brioche bun.',
                'price' => 24.50,
                'category' => 'Main Course',
                'food_type' => 'non-veg',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
            [
                'name' => 'Truffle Mushroom Risotto',
                'description' => 'Creamy arborio rice cooked with wild mushrooms, parmesan cheese, and finished with white truffle oil.',
                'price' => 22.00,
                'category' => 'Main Course',
                'food_type' => 'veg',
                'image' => 'https://images.unsplash.com/photo-1476124369491-e7addf5db371?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Crisp romaine lettuce, house-made croutons, and shaved parmesan cheese tossed in our signature Caesar dressing.',
                'price' => 14.00,
                'category' => 'Starters',
                'food_type' => 'veg',
                'image' => 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
            [
                'name' => 'Molten Chocolate Cake',
                'description' => 'Warm chocolate cake with a gooey center, served with a scoop of Madagascar vanilla bean ice cream.',
                'price' => 12.00,
                'category' => 'Desserts',
                'food_type' => 'veg',
                'image' => 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
            [
                'name' => 'Lobster Bisque',
                'description' => 'Rich and creamy soup made with fresh lobster stock, brandy, and cream.',
                'price' => 18.00,
                'category' => 'Starters',
                'food_type' => 'non-veg',
                'image' => 'https://images.unsplash.com/photo-1547592166-23acbe3226d4?q=80&w=600&auto=format&fit=crop',
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
