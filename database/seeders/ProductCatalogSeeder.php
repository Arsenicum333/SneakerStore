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
                'sport' => 'Training',
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
                'sport' => 'Training',
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
                'sport' => 'Running',
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
                'sport' => 'Running',
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
            [
                'name' => 'Nike Vomero 17',
                'gender' => 'Women',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'Maximum cushioning in the Vomero provides a comfortable ride for everyday runs. Our softest, most cushioned ride has lightweight ZoomX foam stacked on top of responsive ReactX foam in the midsole. Plus, a redesigned traction pattern offers a smooth heel-to-toe transition.',
                    'The upper is made from engineered mesh for soft breathability. Our dual-density midsole has ZoomX foam stacked on top of ReactX foam—13% more responsive than previous React technology—for a comfortable ride.',
                    [
                        'Engineered mesh upper for soft breathability',
                        'Dual-density midsole with ZoomX + ReactX foam',
                        'Pods around the outsole for agility and smooth transitions',
                        'Plush tongue and lining for a snug feel',
                        'Weight: 263g approx. (women\'s UK 5.5)',
                        'Heel-to-toe drop: 10mm',
                    ],
                    'Colour Shown: White/Photon Dust/Summit White/Metallic Silver. Style: HM6804-104. Country/Region of Origin: Vietnam.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        13,
                        159.99,
                        'White/Gray',
                        [
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 22],
                            ['size' => '39', 'stock_quantity' => 24],
                            ['size' => '40', 'stock_quantity' => 26],
                            ['size' => '40.5', 'stock_quantity' => 24],
                            ['size' => '41', 'stock_quantity' => 22],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 16],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Pegasus Premium',
                'gender' => 'Women',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'The Pegasus Premium supercharges responsive cushioning with a triple stack of our most powerful running technologies: ZoomX foam, a sculpted Air Zoom unit and ReactX foam. It\'s the most responsive Pegasus ever, providing high energy return unlike any other.',
                    'With a lighter-than-air upper, it decreases weight and increases breathability so you can fly faster. Your foot sits on top of full-length ZoomX foam, Nike\'s most responsive foam. It delivers incredible energy return with each stride.',
                    [
                        'Breathable, lightweight engineered mesh upper',
                        'Full-length ZoomX foam for maximum energy return',
                        'Full-length Air Zoom unit for springiness underfoot',
                        'ReactX foam foundation (13% more responsive)',
                        'Modified Waffle outsole with high-abrasion rubber',
                        'Weight: 275g approx. (women\'s UK 5.5)',
                        'Heel-to-toe drop: 10mm',
                    ],
                    'Colour Shown: Orange Pulse/Bright Mango/Tattoo/Hot Lava. Style: HQ2593-802. Country/Region of Origin: Vietnam.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        14,
                        209.99,
                        'Red',
                        [
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 22],
                            ['size' => '39', 'stock_quantity' => 24],
                            ['size' => '40', 'stock_quantity' => 26],
                            ['size' => '40.5', 'stock_quantity' => 24],
                            ['size' => '41', 'stock_quantity' => 22],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 16],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Sprint Sister',
                'gender' => 'Women',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Inspired by Nike\'s 1979 women\'s-only track spike, the Sprint Sister returns—reimagined for the street—delivering comfort and flexibility in a polished package.',
                    'The genuine and synthetic upper is durable and breathable, while the low-cut silhouette provides a non-restrictive fit for all-day wear.',
                    [
                        'Genuine and synthetic upper for durability and breathability',
                        'Low-cut silhouette for non-restrictive fit',
                        'Foam midsole for lightweight comfort',
                        'Rubber outsole for traction',
                    ],
                    'Colour Shown: Ridgerock/Ocean Cube/Dark Cinder/Sail. Style: IR5693-256. Country/Region of Origin: Indonesia.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        15,
                        109.99,
                        'Brown/White',
                        [
                            ['size' => '37', 'stock_quantity' => 10],
                            ['size' => '37.5', 'stock_quantity' => 15],
                            ['size' => '38', 'stock_quantity' => 9],
                            ['size' => '38.5', 'stock_quantity' => 14],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 16],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Air Jordan 1 Mid',
                'gender' => 'Women',
                'sport' => 'Basketball',
                'description' => $this->formatDescription(
                    'Heritage style, premium comfort on and off the court. The Air Jordan 1 Mid brings full-court style and premium comfort to an iconic look.',
                    'Its Air-Sole unit cushions play on the hardwood, while the padded collar gives you a supportive feel for all-day wear.',
                    [
                        'Premium leather and synthetic upper for durability and support',
                        'Air-Sole unit in the heel for signature cushioning',
                        'Padded collar for a supportive feel',
                        'Rubber outsole for traction on various surfaces',
                    ],
                    'Colour Shown: Elemental Pink/Iced Carmine/Coconut Milk/Sail. Style: BQ6472-605. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        16,
                        139.99,
                        'White/Pink',
                        [
                            ['size' => '37', 'stock_quantity' => 18],
                            ['size' => '37.5', 'stock_quantity' => 20],
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 16],
                            ['size' => '41.5', 'stock_quantity' => 14],
                            ['size' => '42', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'LeBron XXIII Elite',
                'gender' => 'Women',
                'sport' => 'Basketball',
                'description' => $this->formatDescription(
                    'LeBron\'s carried the game for two decades. Enter the LeBron XXIII Elite. It offers peak lightweight responsiveness thanks to springy, full-length ZoomX foam—perfect for the high speed demands of the modern game.',
                    'The innovative crown-shaped containment system helps you stay locked in. We removed the tongue and implemented a full-length Flyknit upper—perfect for running down opponents and pinning their shots against the glass.',
                    [
                        'Full-length ZoomX foam for lightweight responsiveness',
                        'Crown-shaped containment system for lockdown fit',
                        'Full-length Flyknit upper (tongueless design)',
                        'Carbon-fibre plate for stability and speed',
                        'Engineered jacquard with premium bootie lining',
                        'Multi-directional traction pattern for court feel',
                    ],
                    'Colour Shown: Black/Stadium Green/College Grey/Soft Yellow. Style: IB9557-002. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        17,
                        229.99,
                        'Black/Green',
                        [
                            ['size' => '37', 'stock_quantity' => 18],
                            ['size' => '37.5', 'stock_quantity' => 20],
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 16],
                            ['size' => '41.5', 'stock_quantity' => 14],
                            ['size' => '42', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'JA 3',
                'gender' => 'Women',
                'sport' => 'Basketball',
                'description' => $this->formatDescription(
                    'Every time Ja steps on the court, it\'s showtime. To help him elevate his game, we worked with him to make the bounciest JA signature shoe so far. The JA 3 is light, tough and a game-changer with full-length Hybrid ZoomX foam.',
                    'More zoom. More boom. Full-length Hybrid ZoomX foam gives Ja Nike\'s highest energy return. "It\'s that extra boost when I\'m already moving fast", Ja says.',
                    [
                        'Full-length Hybrid ZoomX foam for highest energy return',
                        'Tuned, zoned outsole with mini JA logos for elite grip',
                        'Lightweight, durable upper for stability',
                        'Foam sockliner for cloud-like feel',
                        'Padded collar for added cushioning',
                        'JA Swoosh logo with graffiti-sprayed design',
                    ],
                    'Colour Shown: Light Chocolate/Silt Red/Metallic Gold. Style: IB6508-200. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        18,
                        169.99,
                        'Red/Black',
                        [
                            ['size' => '37', 'stock_quantity' => 18],
                            ['size' => '37.5', 'stock_quantity' => 20],
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 16],
                            ['size' => '41.5', 'stock_quantity' => 14],
                            ['size' => '42', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Phantom 6 Elite',
                'gender' => 'Women',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'With its icy blue and fiery red and yellow, this Phantom 6 Elite speaks to Erling Haaland\'s inner fire—and his goal-scoring eruptions that ensue. It powers his precision with revolutionary Gripknit, a sticky texture that brings his foot closer to the ball and helps put him in control of every opportunity—because missing isn\'t an option.',
                    'Behind the design: The inner blaze begins with the blue in the heel and core, signifying Erling\'s cool as he calms himself in the heat of the moment. The blue transitions to red and yellow, embodying Erling\'s psyche while highlighting the brightest part of the boot where most goals are scored.',
                    [
                        'Nike Gripknit technology for exceptional touch and control',
                        'Conical studs on the plate for grippy traction',
                        'New shoe frame for natural fit, especially in toe box',
                        'Cushioned sockliner for comfort',
                        'For use on longer, artificial-grass surfaces',
                    ],
                    'Colour Shown: Hot Punch/Green Strike/Black. Style: IH1784-603. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        19,
                        279.99,
                        'Red/Green',
                        [
                            ['size' => '37', 'stock_quantity' => 18],
                            ['size' => '37.5', 'stock_quantity' => 20],
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 16],
                            ['size' => '41.5', 'stock_quantity' => 14],
                            ['size' => '42', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Mercurial Vini Jr.',
                'gender' => 'Women',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'When you\'re on the field, you want to be noticed—just like Vini Jr. Inspired by the flair he brings to every match, these eye-catching boots are made with bouncy Air Zoom cushioning and a wave-like traction pattern to ensure they\'re the last thing defenders see as you blow past.',
                    'Behind the design: The outer metallic layer celebrates Vini Jr.\'s on-field flair and lifelong love of brightly coloured cleats. The second layer is all about the work he put in behind the scenes to earn the right to wear cleats like these.',
                    [
                        'Synthetic leather upper with textured details for better ball control',
                        'Wave-like traction pattern with cascading studs for grip',
                        'Air Zoom cushioning for bouncy feel',
                        'Flyknit material for stretchy, sock-like fit',
                        'Cushioned sockliner for comfort',
                        'For use on dry, natural-grass pitches',
                    ],
                    'Colour Shown: Sunset Pulse/Old Royal. Style: IO9813-640. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        20,
                        169.99,
                        'Pink',
                        [
                            ['size' => '37', 'stock_quantity' => 18],
                            ['size' => '37.5', 'stock_quantity' => 20],
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 20],
                            ['size' => '40.5', 'stock_quantity' => 18],
                            ['size' => '41', 'stock_quantity' => 16],
                            ['size' => '41.5', 'stock_quantity' => 14],
                            ['size' => '42', 'stock_quantity' => 14],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Metcon 10',
                'gender' => 'Women',
                'sport' => 'Training',
                'description' => $this->formatDescription(
                    'Power your cross-training potential with the Metcon 10. It optimises stability for your heavier lifts with an ultra-strong Hyperlift plate and levels up mobility with responsive ReactX foam.',
                    'With increased energy return and a lighter weight than the Metcon 9, it helps you conquer any movement your workout demands. A wider toe box compared with the Metcon 9 lets your toes extend outwards and helps you optimise your power through your whole foot.',
                    [
                        'Ultra-strong Hyperlift plate under heel for heavy lifts',
                        'Wider toe box for power through whole foot',
                        'ReactX foam midsole for increased energy return',
                        'Flex grooves on outsole for flexible cushioning',
                        'Sticky textured grip on midfoot and toe',
                        'Midfoot band and sturdy heel cup for lockdown fit',
                        'Open-holed engineered mesh for breathability',
                        'Tough plastic heel clip for Handstand Push-Ups',
                    ],
                    'Colour Shown: Barely Green/Steam/Light Silver/Black. Style: HQ2620-301. Country/Region of Origin: Vietnam.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        21,
                        99.99,
                        'Green/White',
                        [
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Kiger 10',
                'gender' => 'Unisex',
                'sport' => 'Running',
                'description' => $this->formatDescription(
                    'This light trail-runner has soft Cushlon 3.0 foam and enhanced grip. The Kiger 10 is one of the lightest trail-running shoes we\'ve ever made.',
                    'Its lean, low-profile design is combined with a steady outsole so you can make quick, agile moves on technical trails.',
                    [
                        'Vibram Megagrip outsole with diverse lug pattern for traction',
                        'Cushlon 3.0 foam midsole for cushioning and support',
                        'Forefoot rock shield for protection from debris',
                        'Lean, low-profile design for agility',
                        'Weight: approx. 276.5g (men\'s UK 9)',
                        'Heel-to-toe drop: 5mm',
                    ],
                    'Colour Shown: Black/Volt Ice/Tattoo/Phantom. Style: FV3929-011. Country/Region of Origin: Vietnam.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        22,
                        139.99,
                        'Black',
                        [
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Air Max Ishod',
                'gender' => 'Unisex',
                'sport' => 'Lifestyle',
                'description' => $this->formatDescription(
                    'Infused with elements taken from iconic \'90s hoops shoes, the Air Max Ishod is built with all the durability you need to skate hard. This creative twist on the original Ishod design features updated mesh, exposed Nike Air and a cupsole that breaks in easily.',
                    'Plush and comfortable, the Max Air cushioning has just the right amount of support for long skate sessions.',
                    [
                        'Updated mesh upper for durability',
                        'Exposed Nike Air cushioning',
                        'Cupsole design for easy break-in',
                        'Herringbone outsole pattern for board grip',
                        'Debossed "Ishod" on hidden eyestays',
                        'Embroidered "Wair" on top',
                    ],
                    'Colour Shown: Grand Purple/Noble Purple/Gravity Purple/Black. Style: IR1887-500. Country/Region of Origin: Indonesia.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        23,
                        119.99,
                        'Purple/Black',
                        [
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Giannis Freak 7',
                'gender' => 'Unisex',
                'sport' => 'Basketball',
                'description' => $this->formatDescription(
                    'Obsessed. Driven. Dedicated. For the early-risers and never-quitters, the Giannis Freak 7 is made for the work that takes your game to the next level.',
                    'With lightweight responsiveness, freaky traction and a fluid design, it\'s a signature shoe re-engineered by Giannis and Nike from the ground up to unleash the elite hooper in all of us.',
                    [
                        'Cushlon 3.0 foam with internal moulded cage for responsiveness',
                        'Eurostep-engaging, multi-directional outsole for freaky traction',
                        'Fluid design for free-flowing movement on court',
                        'Secure fit for cutting and slicing through defence',
                    ],
                    'Colour Shown: Light Aqua/Racer Blue/Summit White/Bright Crimson. Style: HF3450-402. Country/Region of Origin: Vietnam.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        24,
                        114.99,
                        'Blue',
                        [
                            ['size' => '38', 'stock_quantity' => 20],
                            ['size' => '38.5', 'stock_quantity' => 18],
                            ['size' => '39', 'stock_quantity' => 22],
                            ['size' => '39.5', 'stock_quantity' => 20],
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike G.T. Cut 4',
                'gender' => 'Unisex',
                'sport' => 'Basketball',
                'description' => $this->formatDescription(
                    'Basketball isn\'t slowing down. The tempo, the pace, the players keep pushing the speed barrier to another dimension. Keep your game on go in the G.T. Cut 4.',
                    'From full-length springy Air Zoom Strobel to a feathery ZoomX drop-in midsole to the cutting-edge upper, this mould-breaker combines our best basketball technologies for the alpha space makers who refuse to settle for anything but winning.',
                    [
                        'Full-length ZoomX 3.0 foam midsole for bounce',
                        'Full-length Air Zoom Strobel cushioning for acceleration',
                        'RBR-X stabiliser for quicker cuts',
                        'Cushlon carrier for stability',
                        'Exoskeleton upper with futuristic design',
                        'Generative traction outsole for acceleration and deceleration',
                        'Low, light and crazy agile court feel',
                    ],
                    'Colour Shown: Persian Violet/Glacier Blue/Chrome. Style: IQ6206-500. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        25,
                        189.99,
                        'Blue/Purple',
                        [
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Nike Tiempo Reactgato',
                'gender' => 'Unisex',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'Turn ball touches into brilliance in the Nike Tiempo Reactgato. Its all-new Techleather material, softer than natural leather, combines with a responsive ReactX midsole to give you the control you need to wreak havoc on any defence.',
                    'Techleather adapts to the shape of your foot for an accommodating, glove-like fit.',
                    [
                        'Techleather upper for super-soft ball touch',
                        'More consistent ball touch than natural leather',
                        'ReactX foam midsole for responsive feel',
                        'Tuned, no-slip traction for direction changes',
                        'For use on street, court and indoor surfaces',
                        'Cushioned sockliner for comfort',
                    ],
                    'Colour Shown: Light Liquid Lime/White. Style: IQ8296-310. Country/Region of Origin: Vietnam.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        26,
                        79.99,
                        'Yellow/White',
                        [
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'Mercurial Academy',
                'gender' => 'Unisex',
                'sport' => 'Football',
                'description' => $this->formatDescription(
                    'Looking to take your speed to the next level? We made these Academy Shoes with an improved heel Air Zoom unit. It gives you the propulsive feel needed to break through the back line.',
                    'The result is the most responsive Mercurial we\'ve ever made, so you can dictate pace and tempo all match long.',
                    [
                        'Improved heel Air Zoom unit for propulsive feel',
                        'NikeSkin upper with embedded chevrons for ball control',
                        'Rubber outsole for traction on turf surfaces',
                        'Adaptable knit for flexibility and support',
                        'Dynamic Fit collar wraps ankle for secure feel',
                        'For use on shorter, synthetic surfaces',
                        'Cushioned insole for comfort',
                    ],
                    'Colour Shown: Black/Ice Blue. Style: FQ8331-001. Country/Region of Origin: Indonesia.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        27,
                        69.99,
                        'Black/Blue',
                        [
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
            [
                'name' => 'LeBron XXIII',
                'gender' => 'Men',
                'sport' => 'Basketball',
                'description' => $this->formatDescription(
                    'LeBron\'s carried the game for two decades. Enter the LeBron XXIII. It offers peak lightweight responsiveness thanks to springy, full-length ZoomX foam—perfect for the high speed demands of the modern game.',
                    'This special design salutes LeBron signing his name on the dotted line with the Swoosh—a partnership that\'s changed the game now and forever. "I\'m a Nike guy," said LeBron. This colourway celebrates that groundbreaking signing.',
                    [
                        'Full-length ZoomX drop-in midsole for optimal bounce',
                        'Carbon-fibre plate for stability and speed',
                        'Crown-shaped containment system for lockdown fit',
                        'Engineered jacquard with premium bootie lining',
                        'Multi-directional traction pattern for court feel',
                    ],
                    'Colour Shown: Safety Orange/Metallic Gold/Wolf Grey. Style: IV5647-800. Country/Region of Origin: China.'
                ),
                'variants' => [
                    $this->makeSingleVariant(
                        28,
                        199.99,
                        'Orange',
                        [
                            ['size' => '40', 'stock_quantity' => 16],
                            ['size' => '40.5', 'stock_quantity' => 14],
                            ['size' => '41', 'stock_quantity' => 18],
                            ['size' => '41.5', 'stock_quantity' => 16],
                            ['size' => '42', 'stock_quantity' => 20],
                            ['size' => '42.5', 'stock_quantity' => 18],
                            ['size' => '43', 'stock_quantity' => 18],
                            ['size' => '43.5', 'stock_quantity' => 16],
                            ['size' => '44', 'stock_quantity' => 14],
                            ['size' => '44.5', 'stock_quantity' => 12],
                            ['size' => '45', 'stock_quantity' => 12],
                        ]
                    ),
                ],
            ],
        ];

        DB::transaction(function () use ($products, $now): void {
            foreach ($products as $productData) {
                $existingProduct = DB::table('products')->where('name', $productData['name'])->first();

                if ($existingProduct) {
                    continue;
                }

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
