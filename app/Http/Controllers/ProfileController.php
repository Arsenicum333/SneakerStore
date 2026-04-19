<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $orders = DB::table('orders')
            ->where('user_id', (int) $user->id)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->map(function ($order) {
                $firstItem = DB::table('order_items as oi')
                    ->join('product_variant_sizes as pvs', 'pvs.id', '=', 'oi.variant_size_id')
                    ->join('product_variants as pv', 'pv.id', '=', 'pvs.variant_id')
                    ->join('products as p', 'p.id', '=', 'pv.product_id')
                    ->leftJoin('product_images as pi', 'pi.variant_id', '=', 'pv.id')
                    ->where('oi.order_id', $order->id)
                    ->select([
                        'p.name as product_name',
                        'pv.id as variant_id',
                        'p.id as product_id',
                        'pi.image_url',
                        'oi.quantity',
                    ])
                    ->orderByDesc('pi.is_main')
                    ->orderBy('pi.display_order')
                    ->first();

                return [
                    'id' => (int) $order->id,
                    'status' => (string) $order->status,
                    'total_amount' => (float) $order->total_amount,
                    'created_at' => $order->created_at,
                    'product_name' => (string) ($firstItem->product_name ?? 'Order item'),
                    'product_id' => (int) ($firstItem->product_id ?? 0),
                    'variant_id' => (int) ($firstItem->variant_id ?? 0),
                    'image_url' => (string) ($firstItem->image_url ?? 'assets/sneakers/sneakers1_1.avif'),
                    'quantity' => (int) ($firstItem->quantity ?? 1),
                ];
            });

        return view('profile', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }
}
