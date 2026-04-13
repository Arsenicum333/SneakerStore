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

    private function makeImages(int $productIndex, ?int $variantNumber = null): array
    {
        return array_map(
            fn (int $photoNumber) => $variantNumber === null
                ? sprintf('assets/sneakers/sneakers%d_%d.avif', $productIndex, $photoNumber)
                : sprintf('assets/sneakers/sneakers%d_%d_%d.avif', $productIndex, $photoNumber, $variantNumber),
            range(1, 8)
        );
    }

    private function makeSingleVariant(int $productIndex, float $price, string $color, array $sizes): array
    {
        return [
            'price' => $price,
            'color' => $color,
            'images' => $this->makeImages($productIndex),
            'sizes' => $sizes,
        ];
    }

    private function makeVariant(int $productIndex, int $variantNumber, float $price, string $color, array $sizes): array
    {
        return [
            'price' => $price,
            'color' => $color,
            'images' => $this->makeImages($productIndex, $variantNumber),
            'sizes' => $sizes,
        ];
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
                'name' => 'Nike Air Max Plus',
                'gender' => 'Men',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'Nike Air Max Plus is a bold runner with a tuned cushioning system and aggressive upper lines that make it feel fast even when you are wearing it casually.',
                    'The mesh build helps with airflow, while the sculpted sole keeps the ride responsive for everyday city movement and longer walks.',
                    [
                        'Tuned cushioning for day-long comfort',
                        'Breathable upper for better airflow',
                        'Stable outsole for city surfaces',
                        'Iconic silhouette with strong street presence',
                    ],
                    'It is a good fit for someone who wants a sneaker that can handle daily wear without losing its running DNA.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        1,
                        189.99,
                        'Pink/Gray',
                        [
                            ['size' => '40', 'stock_quantity' => 24],
                            ['size' => '40.5', 'stock_quantity' => 20],
                            ['size' => '41', 'stock_quantity' => 22],
                            ['size' => '42', 'stock_quantity' => 18],
                            ['size' => '42.5', 'stock_quantity' => 16],
                            ['size' => '43', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Air Max 90',
                'gender' => 'Men',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Nike Air Max 90 keeps the classic silhouette that works with almost anything, from loose denim to sharp casual looks.',
                    'The layered upper gives structure, while the visible cushioning adds a soft underfoot feel that is easy to wear all day.',
                    [
                        'Classic lifestyle profile',
                        'Soft cushioning underfoot',
                        'Durable layered upper',
                        'Easy-to-style color blocking',
                    ],
                    'This is a dependable everyday sneaker for people who want a timeless shape with enough comfort to wear it frequently.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        2,
                        149.99,
                        'Gray/Black',
                        [
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 22],
                            ['size' => '41', 'stock_quantity' => 24],
                            ['size' => '42', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike P-6000',
                'gender' => 'Unisex',
                'sport' => 'Training',
                'description' => $this->formatDescription(
                    'Nike P-6000 mixes retro running energy with modern comfort, making it work both for training days and casual wear.',
                    'Its layered mesh-and-overlay construction keeps the shape structured without feeling too heavy, while the sole remains flexible enough for everyday movement.',
                    [
                        'Retro runner with modern comfort',
                        'Structured but lightweight upper',
                        'Flexible sole for daily wear',
                        'Two colorways for different moods',
                    ],
                    'It is a versatile option for someone who wants a sneaker that looks sporty without being limited to workouts.'
                ),
                'variants' => [
                    $this->makeVariant(
                        3,
                        1,
                        89.99,
                        'White',
                        [
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '41', 'stock_quantity' => 24],
                            ['size' => '42', 'stock_quantity' => 26],
                            ['size' => '43', 'stock_quantity' => 24],
                            ['size' => '44', 'stock_quantity' => 18],
                        ]
                    ),
                    $this->makeVariant(
                        3,
                        2,
                        99.99,
                        'Gray',
                        [
                            ['size' => '40', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 22],
                            ['size' => '42', 'stock_quantity' => 24],
                            ['size' => '43', 'stock_quantity' => 20],
                            ['size' => '44', 'stock_quantity' => 16],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'NikeCourt Lite 4',
                'gender' => 'Women',
                'sport' => 'Tennis',
                'description' => $this->formatDescription(
                    'NikeCourt Lite 4 is built for quick footwork and court stability, with a shape that supports fast movement and confident stops.',
                    'The lightweight upper makes it comfortable for long practice sessions, while the outsole is designed to handle repeated court impact.',
                    [
                        'Court-ready traction',
                        'Lightweight upper for long sessions',
                        'Supportive fit for quick stops',
                        'Clean tennis-inspired styling',
                    ],
                    'It is a practical tennis option that also looks clean enough for everyday wear off the court.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        4,
                        74.99,
                        'Brown/White',
                        [
                            ['size' => '37', 'stock_quantity' => 18],
                            ['size' => '38', 'stock_quantity' => 24],
                            ['size' => '39', 'stock_quantity' => 26],
                            ['size' => '40', 'stock_quantity' => 22],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '42', 'stock_quantity' => 16],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Air Jordan 1 Low',
                'gender' => 'Men',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Air Jordan 1 Low keeps the iconic basketball heritage in a lower profile that feels easy to wear every day.',
                    'The padded collar and clean panel construction give it a familiar Jordan look, while the low cut keeps it versatile for casual styling.',
                    [
                        'Iconic Jordan silhouette',
                        'Padded collar for comfort',
                        'Easy-to-style low profile',
                        'Streetwear-friendly colorway',
                    ],
                    'This is one of those sneakers that can rotate through a lot of outfits without feeling out of place.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        5,
                        129.99,
                        'Blue',
                        [
                            ['size' => '39.5', 'stock_quantity' => 16],
                            ['size' => '40', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 20],
                            ['size' => '42', 'stock_quantity' => 22],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '44', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Tiempo Legend 10',
                'gender' => 'Men',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'Nike Tiempo Legend 10 is made for touch and control, giving football players a dependable boot for passing, positioning, and clean contact.',
                    'The upper keeps the ball feel natural, while the outsole adds the grip needed for quick changes in direction on match day.',
                    [
                        'Touch-focused upper',
                        'Reliable match traction',
                        'Secure fit for sharp movement',
                        'Built for regular football use',
                    ],
                    'It is a strong all-round football option for players who care more about control than flashy distractions.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        6,
                        189.99,
                        'Gray',
                        [
                            ['size' => '41', 'stock_quantity' => 20],
                            ['size' => '41.5', 'stock_quantity' => 22],
                            ['size' => '42', 'stock_quantity' => 24],
                            ['size' => '42.5', 'stock_quantity' => 24],
                            ['size' => '43', 'stock_quantity' => 22],
                            ['size' => '44', 'stock_quantity' => 18],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Air Jordan 1 Low G',
                'gender' => 'Unisex',
                'sport' => 'Golf',
                'description' => $this->formatDescription(
                    'Air Jordan 1 Low G brings Jordan styling to the golf course with a construction that looks familiar but is adapted for playing 18 holes.',
                    'The upper keeps the clean AJ1 feel, while the outsole pattern is designed for stability through the swing and traction on turf.',
                    [
                        'Jordan look for golf',
                        'Stability during the swing',
                        'Golf-specific traction',
                        'Two colorways for choice',
                    ],
                    'It gives golfers a way to keep their look sharp without giving up comfort or practical performance.'
                ),
                'variants' => [
                    $this->makeVariant(
                        7,
                        1,
                        149.99,
                        'White/Blue',
                        [
                            ['size' => '40', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 20],
                            ['size' => '42', 'stock_quantity' => 22],
                            ['size' => '43', 'stock_quantity' => 20],
                            ['size' => '44', 'stock_quantity' => 16],
                        ]
                    ),
                    $this->makeVariant(
                        7,
                        2,
                        149.99,
                        'Green/White',
                        [
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '44', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Maxfly 2',
                'gender' => 'Unisex',
                'sport' => 'Athletics',
                'description' => $this->formatDescription(
                    'Nike Maxfly 2 is a track-focused spike built for speed, with a lightweight feel that suits short-distance racing.',
                    'The upper keeps the fit locked in, while the sole is tuned to help with explosive takeoffs and efficient forward drive.',
                    [
                        'Lightweight race feel',
                        'Locked-in fit for sprinting',
                        'Explosive toe-off support',
                        'Track-ready design language',
                    ],
                    'This one is aimed at runners who want something race-specific rather than a general training shoe.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        8,
                        219.99,
                        'Orange/Green',
                        [
                            ['size' => '41', 'stock_quantity' => 12],
                            ['size' => '41.5', 'stock_quantity' => 14],
                            ['size' => '42', 'stock_quantity' => 16],
                            ['size' => '42.5', 'stock_quantity' => 16],
                            ['size' => '43', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Wildhorse 10',
                'gender' => 'Men',
                'sport' => 'Trail-Running',
                'description' => $this->formatDescription(
                    'Nike Wildhorse 10 is designed for uneven ground and longer trail sessions, with a build that feels protective without becoming too heavy.',
                    'The outsole helps with grip on loose terrain, while the upper keeps the fit secure enough for technical routes.',
                    [
                        'Trail grip on loose ground',
                        'Protective feel for longer runs',
                        'Secure upper for technical trails',
                        'Comfortable for mixed terrain',
                    ],
                    'It works well for runners who want to get off-road without feeling underprepared.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        9,
                        149.99,
                        'Coral/White',
                        [
                            ['size' => '38', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 22],
                            ['size' => '41', 'stock_quantity' => 20],
                            ['size' => '42', 'stock_quantity' => 16],
                            ['size' => '43', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Air Jordan 1 Mid',
                'gender' => 'Unisex',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Air Jordan 1 Mid gives you the classic Jordan look in a mid-cut shape that feels balanced between bold and everyday-friendly.',
                    'The profile is strong enough to stand out, but still easy to pair with casual outfits and regular streetwear rotation.',
                    [
                        'Classic Jordan heritage',
                        'Balanced mid-cut profile',
                        'Works with everyday outfits',
                        'Bold but wearable design',
                    ],
                    'It is a dependable Jordan option when you want something familiar but not too tall on the ankle.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        10,
                        139.99,
                        'Red',
                        [
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '43', 'stock_quantity' => 20],
                            ['size' => '44', 'stock_quantity' => 16],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => "Nike Mercurial Vapor 16 Pro 'Vini Jr.'",
                'gender' => 'Men',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'Nike Mercurial Vapor 16 Pro is built for sharp acceleration and attacking play, giving footballers a very fast, very direct feel underfoot.',
                    'The boot is designed to lock in the foot and keep movement responsive, especially when you are sprinting into space or changing direction quickly.',
                    [
                        'Built for acceleration',
                        'Responsive and locked-in fit',
                        'Fast feel for attacking play',
                        'Signature player edition style',
                    ],
                    'This is a boot for players who want speed-first performance with a standout visual identity.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        11,
                        169.99,
                        'Pink',
                        [
                            ['size' => '42', 'stock_quantity' => 12],
                            ['size' => '42.5', 'stock_quantity' => 14],
                            ['size' => '43', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 16],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Air Force 1 GORE-TEX Vibram',
                'gender' => 'Men',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Air Force 1 GORE-TEX Vibram brings a weather-ready version of the classic AF1, adding a more rugged finish for mixed conditions.',
                    'The materials feel protective and the outsole is built to give a more secure step, making it a strong option for regular city wear.',
                    [
                        'Weather-ready build',
                        'Rugged everyday durability',
                        'Classic AF1 shape with upgrade',
                        'Secure grip underfoot',
                    ],
                    'It keeps the familiar Air Force 1 look but gives it a more functional edge for the kind of weather you cannot control.'
                ),
                'variants' => [
                    $this->makeVariant(
                        12,
                        1,
                        159.99,
                        'Green/Black',
                        [
                            ['size' => '38.5', 'stock_quantity' => 16],
                            ['size' => '39', 'stock_quantity' => 18],
                            ['size' => '39.5', 'stock_quantity' => 18],
                            ['size' => '40.5', 'stock_quantity' => 20],
                            ['size' => '41.5', 'stock_quantity' => 16],
                        ]
                    ),
                    $this->makeVariant(
                        12,
                        2,
                        179.99,
                        'Black',
                        [
                            ['size' => '38.5', 'stock_quantity' => 14],
                            ['size' => '39', 'stock_quantity' => 16],
                            ['size' => '39.5', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 14],
                        ]
                    ),
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

                foreach ($productData['variants'] as $variantIndex => $variantData) {
                    $variantId = DB::table('product_variants')->insertGetId([
                        'product_id' => $productId,
                        'price' => $variantData['price'],
                        'color' => $variantData['color'],
                    ]);

                    foreach ($variantData['images'] as $imageIndex => $imageUrl) {
                        DB::table('product_images')->insert([
                            'variant_id' => $variantId,
                            'image_url' => $imageUrl,
                            'is_main' => $variantIndex === 0 && $imageIndex === 0,
                            'display_order' => $imageIndex + 1,
                        ]);
                    }

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