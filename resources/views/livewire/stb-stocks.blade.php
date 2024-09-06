<div>
    <div class="dark:text-white dark:bg-gray-800 bg-white p-5 ">
        <h2
            class="rounded text-2xl font-semibold text-center rtl:text-right text-white">
            STB List ({{ $stbStock->count() }})
        </h2>
        @if ($msg)
            <h4 class="text-green-300 text-center font-semibold">{{$msg}}</h4>
        @endif
    </div>
    {{-- <button wire:click ="delete">Delete</button> --}}
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-3">
                    NUID
                </th>
                <th scope="col" class="p-3">
                    Category
                </th>
                <th scope="col" class="p-3">
                    Quality
                </th>
                <th scope="col" class="p-3">
                    Stock Status
                </th>
                <th scope="col" class="p-3">
                    Remarks
                </th>
                <th scope="col" class="p-3">
                    Date
                </th>
                {{-- <th scope="col" class="p-3">
                <span class="sr-only">Edit</span>
            </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($stbStock as $stock)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="p-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $stock->nuid }}
                    </th>
                    <td class="p-3">
                        {{ $stock->category }}
                    </td>
                    <td class="p-3">
                        @if ($stock->status == 'error')
                            <span class="text-red-500">Error</span>
                        @else
                        <span class="text-green-500">Good</span>
                        @endif
                    </td>
                    <td class="p-3 ">
                        @if ($stock->is_stock == true)
                            <button wire:click="updateStock({{$stock->id}})" class="text-green-500 font-semibold text-xs rounded-sm px-2 border border-green-400">Yes</button>
                        @else
                            <button wire:click="updateStock({{$stock->id}})" class="text-red-500 font-semibold border border-red-400 text-xs rounded-sm px-2">No</button>
                        @endif
                    </td>
                    <td class="p-3 ">
                        {{ $stock->remarks }}
                    </td>
                    <td class="p-3 ">
                        {{ $stock->created_at->format('d-M-Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
