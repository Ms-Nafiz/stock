<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="dark:text-white dark:bg-gray-800 bg-white p-5 ">
            <h2
                class="rounded text-2xl font-semibold text-center rtl:text-right text-white">
               Technicians ({{ $technicians->count() }})
            </h2>
            @if ($updateMsg)
                <h4 class="text-green-500 text-center font-semibold">{{$updateMsg}}</h4>
            @endif
        </div>
        <div wire:click='$dispatch("openModal",{component:"new-technician"})' class="absolute right-4 top-4 border border-yellow-600 rounded p-1 cursor-pointer hover:border-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" height="25px" viewBox="0 -960 960 960" width="25px" fill="#EAC452"><path d="M708-432v-84h-84v-72h84v-84h72v84h84v72h-84v84h-72Zm-324-48q-60 0-102-42t-42-102q0-60 42-102t102-42q60 0 102 42t42 102q0 60-42 102t-102 42ZM96-192v-92q0-25.78 12.5-47.39T143-366q55-32 116-49t125-17q64 0 125 17t116 49q22 13 34.5 34.61T672-284v92H96Zm72-72h432v-20q0-6.47-3.03-11.76-3.02-5.3-7.97-8.24-47-27-99-41.5T384-360q-54 0-106 14.5T179-304q-4.95 2.94-7.98 8.24Q168-290.47 168-284v20Zm216.21-288Q414-552 435-573.21t21-51Q456-654 434.79-675t-51-21Q354-696 333-674.79t-21 51Q312-594 333.21-573t51 21Zm-.21-73Zm0 361Z"/></svg>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-3">
                        Name
                    </th>
                    <th scope="col" class="p-3">
                        Mobile
                    </th>
                    <th scope="col" class="p-3">
                        Email
                    </th>
                    <th scope="col" class="p-3">
                        Status
                    </th>
                    <th scope="col" class="p-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technicians as $tech)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="p-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$tech->name}}
                    </th>
                    <td class="p-3">
                        {{$tech->mobile}}
                    </td>
                    <td class="p-3">
                        {{$tech->email}}
                    </td>
                    <td class="p-3">
                        @if ($tech->is_active)
                            <span wire:click='updateStatus({{$tech->id}})' class="text-green-500 font-semibold text-xs rounded-sm px-2 border border-green-400 cursor-pointer">Active</span>
                            @else
                            <span wire:click='updateStatus({{$tech->id}})' class="text-red-500 font-semibold text-xs rounded-sm px-2 border border-red-400 cursor-pointer">Inactive</span>
                        @endif
                    </td>
                    <td class="p-3 text-right">
                        <svg class="cursor-pointer" wire:click='$dispatch("openModal",{component: "edit-technician",arguments:{techId:{{$tech->id}}}})' xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#F19E39"><path d="M216-216h51l375-375-51-51-375 375v51Zm-72 72v-153l498-498q11-11 23.84-16 12.83-5 27-5 14.16 0 27.16 5t24 16l51 51q11 11 16 24t5 26.54q0 14.45-5.02 27.54T795-642L297-144H144Zm600-549-51-51 51 51Zm-127.95 76.95L591-642l51 51-25.95-25.05Z"/></svg>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
