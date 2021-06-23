<div class="p-6 bg-white border-b border-gray-200">
    <p class="text-2xl text-gray-600 font-bold mb-6 underline">
        Subscribers
    </p>

    <div class="px-8">
        <x-input wire:model="search" type="text" class="rounded-lg border-gray-300 mb-4 w-full" placeholder="Search"></x-input>
        @if($subscribers->isEmpty())
            <div class="flex w-full bg-red-100 p-5">
                <p class="text-red-800 font-bold">
                    No subscribers found
                </p>
            </div>
        @else
            <table class="w-full">
                <thead class="border-b-2 border-gray-300 text-indigo-300">
                <tr>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Verified</th>
                    <th class="px-6 py-3 text-left"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscribers as $subscriber)
                    <tr class="text-sm text-indigo-900 border-b border-gray-400">
                        <td class="px-6 py-4">
                            {{ $subscriber->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($subscriber->email_verified_at)->diffForHumans() ?? 'Never' }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button wire:click="Delete({{ $subscriber->id }})" class="border border-red-500 text-red-500 bg-red-50 font-bold hover:bg-red-100">X</x-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
