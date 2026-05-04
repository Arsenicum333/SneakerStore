<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return view('admin-profile', compact('user'));
        }

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

    public function adminIndex(): View
    {
        $user = Auth::user();

        return view('admin-profile', [
            'user' => $user,
        ]);
    }

    public function editAdmin()
    {
        $user = Auth::user();
        return view('admin-profile-edit', compact('user'));
    }

    public function updateAdmin(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|required_with:password|current_password',
            'password'   => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->first_name = $validated['first_name'];
        $user->last_name  = $validated['last_name'];
        $user->email      = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
