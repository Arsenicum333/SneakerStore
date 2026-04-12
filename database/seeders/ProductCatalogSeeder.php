<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCatalogSeeder extends Seeder
{
    private function formatDescription(
        string $paragraphOne,
        string $paragraphTwo,
        array $highlights,
        string $closingParagraph
    ): string {
        $bulletList = collect($highlights)
            ->map(fn (string $item) => "- {$item}")
            ->implode("\n");

        return trim($paragraphOne)
            . "\n\n"
            . trim($paragraphTwo)
            . "\n\n"
            . $bulletList
            . "\n\n"
            . trim($closingParagraph);
    }

    /**
     * Seed product catalog with base demo data.
     */
    public function run(): void
    {
        if (DB::table('products')->exists()) {
            return;
        }

        $now = now();

        $products = [
            [
                'name' => 'Nike Air Zoom Pegasus 41',
                'gender' => 'Men',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'Built for comfort and rhythm on daily runs, the Nike Air Zoom Pegasus 41 supports you from your warm-up to your final kilometer with stable cushioning and smooth transitions.',
                    'Its responsive platform helps absorb impact while returning energy, and the breathable engineered upper keeps the fit secure without feeling heavy during long sessions.',
                    [
                        'Balanced cushioning for everyday road training',
                        'Breathable upper with adaptive support',
                        'Durable outsole for steady traction',
                        'Smooth heel-to-toe transition',
                    ],
                    'From short recovery runs to weekend distance work, Pegasus 41 gives you reliable comfort so you can stay focused on pace and form.'
                ),
                'variants' => [
                    [
                        'price' => 139.99,
                        'color' => 'Black/White',
                        'image_url' => 'assets/sneakers/sneakers1.avif',
                        'sizes' => [
                            ['size' => '41', 'stock_quantity' => 7],
                            ['size' => '42', 'stock_quantity' => 9],
                            ['size' => '43', 'stock_quantity' => 6],
                        ],
                    ],
                    [
                        'price' => 139.99,
                        'color' => 'Blue/White',
                        'image_url' => 'assets/sneakers/sneakers11.avif',
                        'sizes' => [
                            ['size' => '42', 'stock_quantity' => 3],
                            ['size' => '43', 'stock_quantity' => 5],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Revolution 8',
                'gender' => 'Women',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'The Nike Revolution 8 is made for easy, comfortable miles with a lightweight build that feels natural from the first step.',
                    'Soft underfoot foam and an airy upper work together to reduce fatigue, while the supportive shape keeps your stride controlled through everyday training.',
                    [
                        'Lightweight construction for effortless movement',
                        'Soft cushioning for daily comfort',
                        'Breathable mesh upper for ventilation',
                        'Reliable grip for city surfaces',
                    ],
                    'Whether you are starting a running routine or adding extra mileage, Revolution 8 delivers comfort you can count on day after day.'
                ),
                'variants' => [
                    [
                        'price' => 89.99,
                        'color' => 'White/Pink',
                        'image_url' => 'assets/sneakers/sneakers2.avif',
                        'sizes' => [
                            ['size' => '37', 'stock_quantity' => 8],
                            ['size' => '38', 'stock_quantity' => 10],
                            ['size' => '39', 'stock_quantity' => 8],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Metcon 10',
                'gender' => 'Unisex',
                'sport' => 'Training',
                'description' => $this->formatDescription(
                    'Nike Metcon 10 is tuned for high-intensity gym work, giving you a stable base for lifts and enough flexibility for explosive movement.',
                    'The responsive setup keeps transitions quick between exercises, while the grippy outsole helps you stay planted during lunges, pushes, and lateral drills.',
                    [
                        'Stable platform for strength sessions',
                        'Responsive feel for fast transitions',
                        'Grippy outsole for multidirectional control',
                        'Durable upper for repeated training',
                    ],
                    'From circuit training to heavy sets, Metcon 10 supports the versatility you need to train harder with confidence.'
                ),
                'variants' => [
                    [
                        'price' => 129.99,
                        'color' => 'Volt/Black',
                        'image_url' => 'assets/sneakers/sneakers3.avif',
                        'sizes' => [
                            ['size' => '41', 'stock_quantity' => 6],
                            ['size' => '42', 'stock_quantity' => 7],
                            ['size' => '43', 'stock_quantity' => 5],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Court Vision Low',
                'gender' => 'Men',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Inspired by classic basketball style, Nike Court Vision Low blends retro lines with everyday comfort for a clean street-ready look.',
                    'The structured upper adds durability and support, while the low-cut profile keeps the shoe easy to wear across long days in the city.',
                    [
                        'Retro basketball-inspired silhouette',
                        'Durable upper for daily wear',
                        'Low-cut collar for comfortable mobility',
                        'Versatile style for casual outfits',
                    ],
                    'If you want a timeless sneaker that works with almost anything, Court Vision Low is a dependable lifestyle choice.'
                ),
                'variants' => [
                    [
                        'price' => 99.99,
                        'color' => 'White/Navy',
                        'image_url' => 'assets/sneakers/sneakers4.avif',
                        'sizes' => [
                            ['size' => '40', 'stock_quantity' => 9],
                            ['size' => '41', 'stock_quantity' => 9],
                            ['size' => '42', 'stock_quantity' => 7],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Blazer Mid 77',
                'gender' => 'Women',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Nike Blazer Mid 77 brings an iconic mid-top profile with heritage details that stand out without feeling overdone.',
                    'Suede overlays add texture and structure, and the classic cupsole construction provides solid everyday comfort with a familiar vintage feel.',
                    [
                        'Iconic mid-top silhouette',
                        'Suede accents for premium texture',
                        'Comfortable cupsole support',
                        'Timeless streetwear styling',
                    ],
                    'Perfect for casual rotation, Blazer Mid 77 combines old-school character with practical all-day wearability.'
                ),
                'variants' => [
                    [
                        'price' => 114.99,
                        'color' => 'Sail/Orange',
                        'image_url' => 'assets/sneakers/sneakers5.avif',
                        'sizes' => [
                            ['size' => '37', 'stock_quantity' => 4],
                            ['size' => '38', 'stock_quantity' => 6],
                            ['size' => '39', 'stock_quantity' => 5],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Tiempo Legend 10',
                'gender' => 'Men',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'Nike Tiempo Legend 10 is built for players who value touch, control, and composure under pressure on the pitch.',
                    'Its upper helps keep close contact with the ball, while the traction layout supports fast cuts and confident acceleration in key moments.',
                    [
                        'Enhanced touch for precise control',
                        'Secure fit for match stability',
                        'Reliable traction for direction changes',
                        'Durable construction for regular play',
                    ],
                    'From possession play to final-third actions, Tiempo Legend 10 helps you stay sharp and in control through the full match.'
                ),
                'variants' => [
                    [
                        'price' => 149.99,
                        'color' => 'Blue/White',
                        'image_url' => 'assets/sneakers/sneakers6.avif',
                        'sizes' => [
                            ['size' => '42', 'stock_quantity' => 3],
                            ['size' => '43', 'stock_quantity' => 7],
                            ['size' => '44', 'stock_quantity' => 6],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Phantom GX Academy',
                'gender' => 'Unisex',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'Nike Phantom GX Academy is made for agile movement and confident attacking play, giving you control when space is tight.',
                    'The boot shape supports quick footwork and clean contact, while the outsole helps maintain traction during sudden turns and bursts forward.',
                    [
                        'Agility-driven profile for quick movements',
                        'Improved ball contact for cleaner touches',
                        'Traction pattern for fast directional changes',
                        'Comfortable fit for full-session play',
                    ],
                    'If your game depends on precision and tempo, Phantom GX Academy is built to help you create and finish chances.'
                ),
                'variants' => [
                    [
                        'price' => 124.99,
                        'color' => 'Purple/Black',
                        'image_url' => 'assets/sneakers/sneakers7.avif',
                        'sizes' => [
                            ['size' => '41', 'stock_quantity' => 4],
                            ['size' => '42', 'stock_quantity' => 6],
                            ['size' => '42.5', 'stock_quantity' => 4],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Air Max Pulse',
                'gender' => 'Men',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Nike Air Max Pulse delivers modern street style with visible cushioning designed to keep every step soft and smooth.',
                    'A supportive upper and cushioned midsole combine for comfort during long city days, while the silhouette keeps your look clean and contemporary.',
                    [
                        'Visible Air cushioning for impact comfort',
                        'Supportive upper for daily wear',
                        'Modern design language for street looks',
                        'Durable outsole for urban traction',
                    ],
                    'From commuting to evening plans, Air Max Pulse gives you all-day comfort with standout Nike identity.'
                ),
                'variants' => [
                    [
                        'price' => 159.99,
                        'color' => 'Grey/Black',
                        'image_url' => 'assets/sneakers/sneakers8.avif',
                        'sizes' => [
                            ['size' => '42', 'stock_quantity' => 4],
                            ['size' => '43', 'stock_quantity' => 5],
                            ['size' => '44', 'stock_quantity' => 5],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Structure 25',
                'gender' => 'Women',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'Built for comfort and stability on every run, Nike Structure 25 supports your stride from the first step to the final kilometer.',
                    'Its responsive cushioning helps absorb impact while maintaining energy return, and the breathable upper keeps the fit secure and natural as you move.',
                    [
                        'Supportive design for stable road running',
                        'Responsive cushioning for all-day comfort',
                        'Breathable upper for improved airflow',
                        'Durable outsole for reliable traction',
                    ],
                    'From short runs to longer sessions, Structure 25 helps you stay focused on your pace while delivering dependable support.'
                ),
                'variants' => [
                    [
                        'price' => 144.99,
                        'color' => 'Coral/White',
                        'image_url' => 'assets/sneakers/sneakers9.avif',
                        'sizes' => [
                            ['size' => '38', 'stock_quantity' => 5],
                            ['size' => '39', 'stock_quantity' => 7],
                            ['size' => '40', 'stock_quantity' => 8],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike Dunk Low Retro',
                'gender' => 'Unisex',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Nike Dunk Low Retro keeps the classic court-inspired shape that became a streetwear staple across generations.',
                    'Premium paneling and a padded collar create a secure, comfortable fit, while the low-cut profile makes it easy to style for everyday use.',
                    [
                        'Classic low-top basketball heritage',
                        'Padded collar for added comfort',
                        'Durable leather-like panel structure',
                        'Easy-to-style everyday silhouette',
                    ],
                    'If you want a sneaker with iconic DNA and versatile wearability, Dunk Low Retro stays relevant season after season.'
                ),
                'variants' => [
                    [
                        'price' => 119.99,
                        'color' => 'Red/White',
                        'image_url' => 'assets/sneakers/sneakers10.avif',
                        'sizes' => [
                            ['size' => '40', 'stock_quantity' => 7],
                            ['size' => '41', 'stock_quantity' => 8],
                            ['size' => '42', 'stock_quantity' => 7],
                        ],
                    ],
                    [
                        'price' => 119.99,
                        'color' => 'Black/White',
                        'image_url' => 'assets/sneakers/sneakers4.avif',
                        'sizes' => [
                            ['size' => '41', 'stock_quantity' => 5],
                            ['size' => '42', 'stock_quantity' => 4],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike React Infinity Run',
                'gender' => 'Men',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'Nike React Infinity Run is designed for runners who want a smooth, protected ride during everyday training.',
                    'Its responsive foam setup balances soft landings with efficient energy return, helping you maintain rhythm over longer distances.',
                    [
                        'Responsive cushioning for steady pacing',
                        'Comfort-focused geometry for daily runs',
                        'Supportive upper for secure lockdown',
                        'Durable outsole for repeat mileage',
                    ],
                    'Whether you are building volume or recovering between harder workouts, React Infinity Run keeps each run consistent and comfortable.'
                ),
                'variants' => [
                    [
                        'price' => 169.99,
                        'color' => 'Blue/Volt',
                        'image_url' => 'assets/sneakers/sneakers11.avif',
                        'sizes' => [
                            ['size' => '43', 'stock_quantity' => 4],
                            ['size' => '44', 'stock_quantity' => 6],
                            ['size' => '45', 'stock_quantity' => 6],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nike ZoomX Zegama 2',
                'gender' => 'Women',
                'sport' => 'Trail',
                'description' => $this->formatDescription(
                    'Nike ZoomX Zegama 2 is built for trail runners who need cushioning confidence and secure traction on mixed terrain.',
                    'The high-comfort foam platform smooths out rough sections, while the outsole pattern grips reliably when trails turn loose, wet, or uneven.',
                    [
                        'Trail-tuned grip for varied surfaces',
                        'Plush cushioning for longer outings',
                        'Stable platform for technical sections',
                        'Protective upper for outdoor durability',
                    ],
                    'From rolling forest routes to steep climbs, ZoomX Zegama 2 helps you move further with control and confidence.'
                ),
                'variants' => [
                    [
                        'price' => 179.99,
                        'color' => 'Teal/Black',
                        'image_url' => 'assets/sneakers/sneakers12.avif',
                        'sizes' => [
                            ['size' => '38.5', 'stock_quantity' => 3],
                            ['size' => '39.5', 'stock_quantity' => 5],
                            ['size' => '40.5', 'stock_quantity' => 4],
                        ],
                    ],
                ],
            ],
        ];

        DB::transaction(function () use ($products, $now): void {
            foreach ($products as $productData) {
                $productId = DB::table('products')->insertGetId([
                    'name' => $productData['name'],
                    'gender' => $productData['gender'],
                    'sport' => $productData['sport'],
                    'description' => $productData['description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                foreach ($productData['variants'] as $index => $variantData) {
                    $variantId = DB::table('product_variants')->insertGetId([
                        'product_id' => $productId,
                        'price' => $variantData['price'],
                        'color' => $variantData['color'],
                    ]);

                    DB::table('product_images')->insert([
                        'variant_id' => $variantId,
                        'image_url' => $variantData['image_url'],
                        'is_main' => $index === 0,
                        'display_order' => 1,
                    ]);

                    $sizeRows = collect($variantData['sizes'])
                        ->map(fn (array $sizeData) => [
                            'variant_id' => $variantId,
                            'size' => $sizeData['size'],
                            'stock_quantity' => $sizeData['stock_quantity'],
                        ])
                        ->all();

                    DB::table('product_variant_sizes')->insert($sizeRows);
                }
            }
        });
    }
}
