<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('sign-in', [
            'redirectTarget' => $this->resolveRedirectTarget($request),
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'redirect' => ['nullable', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password_hash)) {
            return back()->withErrors(['email' => 'Wrong email or password'])->onlyInput(['email', 'redirect']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        $this->mergeSessionBagIntoUserBag((int) Auth::id());

        if ($user->is_admin) {
            return redirect()->route('admin.products');
        }

        $redirect = $this->sanitizeRedirect((string) $request->input('redirect', ''))
            ?? $this->sanitizeRedirect((string) $request->session()->pull('auth.redirect', ''));

        if ($redirect !== null) {
            return redirect($redirect);
        }

        return redirect()->intended(route('profile'));
    }

    public function showRegister(Request $request)
    {
        return view('log-in', [
            'redirectTarget' => $this->resolveRedirectTarget($request),
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dob_day' => ['required', 'integer', 'min:1', 'max:31'],
            'dob_month' => ['required', 'integer', 'min:1', 'max:12'],
            'dob_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'redirect' => ['nullable', 'string'],
        ]);

        $dateOfBirth = sprintf('%04d-%02d-%02d', $validated['dob_year'], $validated['dob_month'], $validated['dob_day']);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'date_of_birth' => $dateOfBirth,
            'is_admin' => false,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $this->mergeSessionBagIntoUserBag((int) $user->id);

        if ($user->is_admin) {
            return redirect()->route('admin.products');
        }

        $redirect = $this->sanitizeRedirect((string) ($validated['redirect'] ?? ''))
            ?? $this->sanitizeRedirect((string) $request->session()->pull('auth.redirect', ''));

        if ($redirect !== null) {
            return redirect($redirect);
        }

        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function mergeSessionBagIntoUserBag(int $userId): void
    {
        $sessionItems = session('bag.items', []);

        if ($sessionItems === []) {
            return;
        }

        $bagId = $this->getOrCreateUserBagId($userId);

        $existingItems = DB::table('bag_items')
            ->where('bag_id', $bagId)
            ->get(['variant_size_id', 'quantity'])
            ->mapWithKeys(fn ($row) => [(string) $row->variant_size_id => ['quantity' => (int) $row->quantity]])
            ->all();

        foreach ($sessionItems as $sizeId => $item) {
            $sizeKey = (string) $sizeId;
            $existingQuantity = (int) ($existingItems[$sizeKey]['quantity'] ?? 0);
            $incomingQuantity = max(1, min(99, (int) ($item['quantity'] ?? 1)));

            $existingItems[$sizeKey] = [
                'quantity' => min(99, $existingQuantity + $incomingQuantity),
            ];
        }

        DB::table('bag_items')->where('bag_id', $bagId)->delete();

        if ($existingItems !== []) {
            $rows = [];

            foreach ($existingItems as $sizeId => $item) {
                $rows[] = [
                    'bag_id' => $bagId,
                    'variant_size_id' => (int) $sizeId,
                    'quantity' => (int) $item['quantity'],
                ];
            }

            DB::table('bag_items')->insert($rows);
        }

        session()->forget('bag.items');
    }

    private function getOrCreateUserBagId(int $userId): int
    {
        $bagId = DB::table('bags')
            ->where('user_id', $userId)
            ->value('id');

        if ($bagId) {
            DB::table('bags')
                ->where('id', $bagId)
                ->update([
                    'session_token' => session()->getId(),
                    'updated_at' => now(),
                ]);

            return (int) $bagId;
        }

        return (int) DB::table('bags')->insertGetId([
            'user_id' => $userId,
            'session_token' => session()->getId(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function resolveRedirectTarget(Request $request): ?string
    {
        $explicitRedirect = $this->sanitizeRedirect((string) $request->query('redirect', ''));

        if ($explicitRedirect !== null) {
            $request->session()->put('auth.redirect', $explicitRedirect);

            return $explicitRedirect;
        }

        $previousUrl = url()->previous();
        $path = (string) parse_url($previousUrl, PHP_URL_PATH);
        $query = (string) (parse_url($previousUrl, PHP_URL_QUERY) ?? '');

        $candidate = $path !== ''
            ? $path . ($query !== '' ? '?' . $query : '')
            : null;

        $fallbackRedirect = $this->sanitizeRedirect((string) $candidate);

        if ($fallbackRedirect !== null) {
            $request->session()->put('auth.redirect', $fallbackRedirect);
        }

        return $fallbackRedirect;
    }

    private function sanitizeRedirect(string $redirect): ?string
    {
        if ($redirect === '' || !str_starts_with($redirect, '/')) {
            return null;
        }

        $parsedRedirect = parse_url($redirect);

        if ($parsedRedirect === false) {
            return null;
        }

        if (array_key_exists('scheme', $parsedRedirect) || array_key_exists('host', $parsedRedirect)) {
            return null;
        }

        if (str_starts_with($redirect, '//')) {
            return null;
        }

        $path = (string) (parse_url($redirect, PHP_URL_PATH) ?? '/');
        $disallowedPaths = ['/login', '/register', '/logout'];

        if (in_array($path, $disallowedPaths, true)) {
            return null;
        }

        return $redirect;
    }
}
