<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="w-1/2 mx-auto p-2 bg-sky-100 rounded mb-2 min-h-[200px]">
            {{-- <h3 class="text-xl text-center font-semibold my-2">Search by Id</h3> --}}
            <div class="flex justify-between w-full">
                <div class="w-1/2">
                    <h2 class="text-base my-2 font-semibold">Search by NUID</h2>
                    <form wire:submit.prevent='search'>
                        <input wire:model.defer='nuid' maxlength="10" minlength="10" id="email" name="email"
                            type="text" required
                            class="block w-full rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none sm:text-sm sm:leading-6">
                        <button type="submit"
                            class="w-full mt-2 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
                    </form>
                    @if ($msg)
                        <div class="text-center">
                            <span
                                class="items-center w-full rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10 my-2 block">{{ $msg }}
                            </span>
                        </div>
                        @if ($results == null)
                            <div class="text-center">
                                <button wire:click='addStb'
                                    class="text-xs py-1 px-4 bg-indigo-500 rounded-sm text-white">Add
                                </button>
                            </div>
                        @endif
                    @endif

                </div>
                {{-- search results --}}
                <div>
                    @if ($results !== null)
                        <div
                            class="min-w-[200px] text-xs bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 m-2">
                            <div class="px-2 py-1">
                                <div class="font-bold text-base mb-2 text-gray-800">Record Details
                                    ({{ $results->transaction->count() }})</div>
                                <div class="flex justify-between">
                                    <p class="text-gray-700 mb-2">
                                        <span class="font-semibold">NUID:</span> {{ $results->nuid }}
                                    </p>
                                    <p class="text-gray-700 mb-2">
                                        <span class="font-semibold">Stock:</span>
                                        @if ($results->is_stock == true)
                                            <span class="text-green-500 font-semibold">Yes</span>
                                        @else
                                            <span class="text-red-500 font-semibold">No</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-gray-700 mb-2">
                                        <span class="font-semibold">Category:</span> {{ $results->category }}
                                    </p>
                                    <p class="text-gray-700 mb-2">
                                        <span class="font-semibold">Status:</span>
                                        <button wire:click='statusUpdate({{ $results->id }})'
                                            class="hover:text-indigo-500 text-{{ $results->status == 'good' ? 'green' : 'red' }}-500">
                                            {{ ucwords($results->status) }}
                                        </button>
                                    </p>
                                </div>
                                <p class="text-gray-700">
                                    <span class="font-semibold">Remarks:</span>
                                    {{ $results->remarks }}
                                </p>
                            </div>
                            <div class="flex justify-end">
                                <button
                                    wire:click="$dispatch('openModal',{component: 'add-transaction',arguments: {id: {{ $results->id }}}})""
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                    Add
                                </button>
                            </div>
                        </div>
                        @if ($statusMsg)
                            <div class="text-center">
                                <span
                                    class="text-indigo-600 text-center font-semibold text-xs ">{{ $statusMsg }}</span>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>

        <div class="relative">
            <h2
                class="p-5 rounded text-2xl font-semibold text-center rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                STB Transactions ({{ $stbTransaction->count() }})
            </h2>
            @if ($deleteMsg)
                <div class="text-center">
                    <span class="text-green-500 font-semibold text-sm">{{ $deleteMsg }}</span>
                </div>
            @endif
            <div class="absolute right-2 top-6 dark:text-white text-xs">
                <form wire:submit.prevent='findTransaction'>
                    <input wire:model.defer='formDate' class="p-1 rounded outline-none text-black" type="date"
                        required>
                    <input wire:model.defer='toDate' class="p-1 rounded outline-none text-black" type="date"
                        required>
                    <button type="submit" class="bg-indigo-500 rounded p-1">Find</button>
                </form>
            </div>
            {{-- {{$stbTransaction}} --}}
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        {{-- <th scope="col" class="p-3">
                            Name
                        </th> --}}
                        <th scope="col" class="p-3">
                            NUID
                        </th>
                        <th scope="col" class="p-3">
                            Address
                        </th>
                        <th scope="col" class="p-3">
                            Type
                        </th>
                        <th scope="col" class="p-3">
                            Technician
                        </th>
                        <th scope="col" class="p-3">
                            Notes
                        </th>
                        <th scope="col" class="p-3">
                            Deposit
                        </th>
                        <th scope="col" class="p-3">
                            C-Id
                        </th>
                        <th scope="col" class="p-3">
                            Date
                        </th>
                        <th scope="col" class="p-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stbTransaction as $transaction)
                        <tr class="bg-white border-b dark:bg-gray-800  dark:border-gray-700">
                            {{-- <td class="p-3 dark:text-white">
                                @php
                                    $newCustomer = $transaction->api_data['new_customer']['name'] ?? null;
                                    $existingCustomer = $transaction->api_data['customer']['name'] ?? null;
                                    $other = $transaction->api_data['others_complain']['name'] ?? null;
                                @endphp
                                @if ($newCustomer !== null)
                                    {{ ucwords($newCustomer) }}
                                @elseif ($existingCustomer !== null)
                                    {{ ucwords($existingCustomer) }}
                                @elseif ($other !== null)
                                    {{ ucwords($other) }}
                                @else
                                    {{ null }}
                                @endif
                            </td> --}}
                            <th scope="row" class="p-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($transaction->exchange_for !== null)
                                    <span class="flex items-center">
                                        <span>{{ $transaction->stb->nuid }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="17px" viewBox="0 -960 960 960"
                                            width="24px" fill="#EA33F7">
                                            <path
                                                d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z" />
                                        </svg>
                                        <span>{{ $transaction->exchange_for }} (old)</span>
                                    </span>
                                @else
                                    <span>{{ $transaction->stb->nuid }}</span>
                                @endif

                            </th>
                            <td class="p-3">
                                {{ $transaction->address . ', ' . $transaction->building->name }}
                            </td>
                            <td class="p-3">
                                {{ $transaction->TransactionType->types }}
                            </td>
                            <td class="p-3 ">
                                {{ $transaction->technician->name }}
                            </td>
                            <td class="p-3 ">
                                @if ($transaction->notes->isNotEmpty())
                                    {{ $transaction->notes->first()->note }}
                                @endif
                            </td>
                            <td class="p-3 ">
                                @php
                                    $depositStatus = $transaction->api_data['new_customer']['deposit_status'] ?? null;
                                @endphp
                                @if ($depositStatus === 'Paid')
                                    <span class="text-green-500 font-semibold">Paid</span>
                                @elseif ($depositStatus === 'Pending')
                                    <span class="text-red-500 font-semibold">Pending</span>
                                @else
                                    {{ null }}
                                @endif
                            </td>
                            <td class="p-3">
                                {{ $transaction->complain_id }}
                            </td>
                            <td class="p-3 ">
                                {{ $transaction->created_at->format('d-M-Y') }}
                            </td>
                            <td>
                                <span class="flex gap-1">
                                    <svg wire:click='deleteTransaction({{ $transaction->id }})'
                                        class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="18px"
                                        viewBox="0 -960 960 960" width="24px" fill="#EA3323">
                                        <path
                                            d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                    </svg>
                                    <svg wire:click="$dispatch('openModal',{component:'transaction-edit',arguments:{id:{{ $transaction->id }}}})"
                                        class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="18px"
                                        viewBox="0 -960 960 960" width="18px" fill="#FFFF55">
                                        <path
                                            d="M216-216h37.92l411.93-411.92-37.93-37.93L216-253.92V-216Zm-3.51 32q-11.91 0-20.2-8.09-8.29-8.08-8.29-20.03v-31.48q0-11.59 4.23-22.11t12.92-19.21l480.08-481.62q5.15-5.48 10.91-7.47 5.76-1.99 11.99-1.99 6.22 0 11.78 1.54 5.55 1.54 11.94 7.15l38.69 37.93q5.61 6.38 7.54 12 1.92 5.63 1.92 11.79 0 6.58-2.26 12.59-2.26 6.02-7.2 11L284.92-201.15q-8.69 8.69-19.16 12.92T243.73-184h-31.24Zm532.28-521.31-39.46-39.46 39.46 39.46Zm-98.22 58.76-18.63-19.3 37.93 37.93-19.3-18.63Z" />
                                    </svg>
                                    <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="18px"
                                        viewBox="0 -960 960 960" width="18px" fill="#75FB4C">
                                        <path
                                            d="M700.62-216v52.62q0 7.75 5.81 13.56Q712.25-144 720-144t13.57-5.82q5.81-5.81 5.81-13.56V-216H792q7.75 0 13.57-5.82 5.81-5.81 5.81-13.56 0-7.76-5.81-13.57-5.82-5.82-13.57-5.82h-52.62v-52.61q0-7.76-5.81-13.57-5.82-5.82-13.57-5.82t-13.57 5.82q-5.81 5.81-5.81 13.57v52.61H648q-7.75 0-13.57 5.82-5.81 5.81-5.81 13.57 0 7.75 5.81 13.56Q640.25-216 648-216h52.62Zm-460 32q-23.36 0-39.99-16.63Q184-217.26 184-240.62v-478.76q0-23.36 16.63-39.99Q217.26-776 240.62-776h478.76q23.36 0 39.99 16.63Q776-742.74 776-719.38v208.61q0 6.8-4.55 11.4-4.54 4.6-11.27 4.6-6.72 0-11.45-4.6-4.73-4.6-4.73-11.4v-208.61q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H240.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v478.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69h208.61q6.8 0 11.4 4.55 4.6 4.54 4.6 11.27 0 6.72-4.6 11.45-4.6 4.73-11.4 4.73H240.62ZM216-239.73V-216v-528V-492.77v-2V-239.73Zm92-93.68q0 6.72 4.6 11.45 4.6 4.73 11.4 4.73h135.38q6.8 0 11.4-4.55 4.6-4.55 4.6-11.27t-4.6-11.45q-4.6-4.73-11.4-4.73H324q-6.8 0-11.4 4.55-4.6 4.54-4.6 11.27Zm0-146.77q0 6.72 4.6 11.45Q317.2-464 324-464h275.23q6.8 0 11.4-4.55 4.6-4.54 4.6-11.27 0-6.72-4.6-11.45-4.6-4.73-11.4-4.73H324q-6.8 0-11.4 4.55-4.6 4.54-4.6 11.27Zm0-146.77q0 6.72 4.6 11.45 4.6 4.73 11.4 4.73h312q6.8 0 11.4-4.55 4.6-4.54 4.6-11.27 0-6.72-4.6-11.45-4.6-4.73-11.4-4.73H324q-6.8 0-11.4 4.55-4.6 4.55-4.6 11.27ZM719.77-83.38q-63.62 0-107.69-44.31Q568-171.99 568-235.61q0-63.62 44.3-107.7 44.31-44.07 107.93-44.07 63.62 0 107.69 44.3Q872-298.78 872-235.16q0 63.62-44.3 107.7-44.31 44.08-107.93 44.08Z" />
                                    </svg>
                                    <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="16px"
                                        viewBox="0 -960 960 960" width="16px" fill="#75FB4C">
                                        <path
                                            d="M479.79-288q15.21 0 25.71-10.35T516-324v-168q0-15.3-10.29-25.65Q495.42-528 480.21-528t-25.71 10.35Q444-507.3 444-492v168q0 15.3 10.29 25.65Q464.58-288 479.79-288Zm0-312q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm.49 504Q401-96 331-126t-122.5-82.5Q156-261 126-330.96t-30-149.5Q96-560 126-629.5q30-69.5 82.5-122T330.96-834q69.96-30 149.5-30t149.04 30q69.5 30 122 82.5T834-629.28q30 69.73 30 149Q864-401 834-331t-82.5 122.5Q699-156 629.28-126q-69.73 30-149 30Zm-.28-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm0-312Z" />
                                    </svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
