@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<main class="max-w-[1200px] mx-auto ~px-4/6">
    <div class="flex flex-col lg:flex-row ~gap-8/16">
        <div class="flex-1 flex flex-col ~gap-4/6">
            <h1 class="~text-xl/3xl font-semibold">My profile</h1>

            <div class="flex items-center ~gap-3/5">
                <div>
                    <div class="inline-flex items-center gap-2">
                        <p class="~text-lg/2xl font-bold text-gray-900 inline-block" id="name-display">{{ $user->first_name }} {{ $user->last_name }}</p>
                        <button class="text-gray-400 hover:text-gray-700 edit-trigger" data-field="name" aria-label="Edit name">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="hidden mt-2" id="name-edit">
                        <input type="text" id="first_name" value="{{ $user->first_name }}" placeholder="First Name" class="border rounded px-2 py-1 ~text-sm">
                        <input type="text" id="last_name" value="{{ $user->last_name }}" placeholder="Last Name" class="border rounded px-2 py-1 ~text-sm">
                        <button class="save-btn text-gray-400 hover:text-gray-600 ml-1" data-field="name">✓</button>
                        <button class="cancel-btn text-gray-400 hover:text-gray-600">✕</button>
                    </div>
                    <p class="~text-xs/sm text-gray-400">Iken Member Since {{ $user->created_at?->format('F Y') }}</p>
                </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center ~gap-2/3">
                        <img src="{{ asset('assets/lucide/letter.svg') }}" class="~w-4/5 ~h-4/5 block">
                        <span class="~text-xs/sm text-gray-700">{{ $user->email }}</span>
                    </div>
                    <span class="~text-xs/sm text-gray-400 italic">Cannot edit email</span>
                </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center ~gap-2/3">
                        <img src="{{ asset('assets/lucide/lock.svg') }}" class="~w-4/5 ~h-4/5 block">
                        <span class="~text-xs/sm text-gray-700 tracking-widest">••••••••</span>
                    </div>
                    <span class="~text-xs/sm text-gray-400 italic">Cannot edit password</span>
                </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center ~gap-2/3">
                        <img src="{{ asset('assets/lucide/map.svg') }}" class="~w-4/5 ~h-4/5 block">
                        <span class="~text-xs/sm text-gray-700" id="address-display">{{ $user->address ?: 'No address added yet' }}</span>
                        <div class="hidden" id="address-edit">
                            <input type="text" id="address" value="{{ $user->address }}" class="border rounded px-2 py-1 ~text-sm w-64">
                            <button class="save-btn text-gray-400 hover:text-gray-600 ml-1" data-field="address">✓</button>
                            <button class="cancel-btn text-gray-400 hover:text-gray-600">✕</button>
                        </div>
                    </div>
                    <a href="#" class="~text-xs/sm text-gray-700 font-medium flex items-center gap-0.5 hover:text-gray-900 edit-trigger" data-field="address">
                        Edit
                        <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </a>
                </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center ~gap-2/3">
                        <img src="{{ asset('assets/lucide/calender.svg') }}" class="~w-4/5 ~h-4/5 block">
                        <span class="~text-xs/sm text-gray-700" id="dob-display">{{ $user->date_of_birth?->format('Y - m - d') ?: 'Not set' }}</span>
                        <div class="hidden" id="dob-edit">
                            <input type="date" id="date_of_birth" value="{{ $user->date_of_birth?->format('Y-m-d') }}" class="border rounded px-2 py-1 ~text-sm">
                            <button class="save-btn text-gray-400 hover:text-gray-600 ml-1" data-field="dob">✓</button>
                            <button class="cancel-btn text-gray-400 hover:text-gray-600">✕</button>
                        </div>
                    </div>
                    <a href="#" class="~text-xs/sm text-gray-700 font-medium flex items-center gap-0.5 hover:text-gray-900 edit-trigger" data-field="dob">
                        Edit
                        <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </a>
                </div>
            </div>

            <form action="{{ route('logout.perform') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
                    Log Out
                </button>
            </form>
        </div>

        <div class="lg:w-80 flex-shrink-0">
            <div class="~mb-5/8">
                <h1 class="~text-xl/3xl font-semibold text-gray-900">My orders</h1>
            </div>

            <div class="flex flex-col ~gap-4/8">
                @forelse ($orders as $order)
                    @php
                        $statusNormalized = strtolower($order['status']);
                        $statusLabel = match ($statusNormalized) {
                            'pending' => 'On the way',
                            'delivered' => 'Delivered',
                            default => ucfirst($statusNormalized),
                        };
                        $statusColor = $statusNormalized === 'delivered' ? 'text-green-500' : 'text-red-500';
                    @endphp
                    <div class="flex flex-row ~gap-3/5">
                        <a href="{{ $order['product_id'] && $order['variant_id'] ? route('product.show', ['product' => $order['product_id'], 'variant' => $order['variant_id']]) : '#' }}" class="bg-gray-100 rounded-md flex-shrink-0">
                            <img src="{{ asset($order['image_url']) }}" class="~w-16/40 ~h-16/40 block rounded-md object-cover" alt="{{ $order['product_name'] }}">
                        </a>
                        <div class="flex flex-col ~gap-0.5/1">
                            <div class="flex flex-col ~gap-0.5/1">
                                <h2 class="font-semibold text-base">{{ $order['product_name'] }}</h2>
                                <p class="text-gray-500 text-base font-semibold">{{ number_format($order['total_amount'], 2, ',', ' ') }} $</p>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <p class="{{ $statusColor }} text-sm">{{ $statusLabel }}</p>
                                <p class="text-gray-500 text-sm">{{ \Illuminate\Support\Carbon::parse($order['created_at'])->format('d F, Y') }}</p>
                                <p class="text-gray-500 text-sm">№{{ $order['id'] }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">You don&apos;t have any orders yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-trigger').forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            const field = this.dataset.field;
            showEditForm(field);
        });
    });

    document.querySelectorAll('.save-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const field = this.dataset.field;
            saveField(field);
        });
    });

    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const field = this.closest('[id$="-edit"]')?.id?.replace('-edit', '');
            if (field) hideEditForm(field);
        });
    });

    function showEditForm(field) {
        document.getElementById(`${field}-display`)?.classList.add('hidden');
        document.getElementById(`${field}-edit`)?.classList.remove('hidden');
    }

    function hideEditForm(field) {
        document.getElementById(`${field}-display`)?.classList.remove('hidden');
        document.getElementById(`${field}-edit`)?.classList.add('hidden');
    }

    function saveField(field) {
        let formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        if (field === 'name') {
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
        } else if (field === 'address') {
            formData.append('address', document.getElementById('address').value);
        } else if (field === 'dob') {
            formData.append('date_of_birth', document.getElementById('date_of_birth').value);
        }

        fetch('{{ route("profile.update") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (field === 'name') {
                    document.getElementById('name-display').textContent = data.first_name + ' ' + data.last_name;
                } else if (field === 'address') {
                    document.getElementById('address-display').textContent = data.address || 'No address added yet';
                } else if (field === 'dob') {
                    document.getElementById('dob-display').textContent = data.date_of_birth || 'Not set';
                }
                hideEditForm(field);
                showMessage('Profile updated successfully!', 'success');
            } else {
                showMessage(data.message || 'Error updating profile', 'error');
            }
        })
        .catch(error => {
            showMessage('Error updating profile', 'error');
        });
    }

    function showMessage(msg, type) {
        let div = document.createElement('div');
        div.className = `fixed top-4 right-4 px-4 py-2 rounded shadow-lg z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        div.textContent = msg;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }
});
</script>
@endsection
