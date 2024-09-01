<div>
    <div class="flex justify-between gap-4">
        <div class="Area w-full">
            <div class="dark:text-white dark:bg-gray-800 bg-white p-3 rounded">
                <h2 class="rounded text-xl font-semibold text-center rtl:text-right text-white">
                    Area ({{ $areaList->count() }})
                </h2>
                <div class="flex gap-2 mt-6">
                    <div class="w-full">
                        <form wire:submit.prevent='addArea'>
                            <div class="flex gap-1">
                                <input wire:model.defer='areaName'
                                    class="block w-full text-xs rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none"
                                    type="text" placeholder="Add Area" required>
                                <button type="submit" class="bg-indigo-500 text-xs p-1 rounded">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="w-full">
                        <form wire:submit.prevent='addBuilding'>
                            <div class="flex gap-1">
                                <select wire:model.defer='parentArea'
                                    class="block w-full text-xs rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none"
                                    type="text" placeholder="Add Area" required>
                                    <option value="">Select Area</option>
                                    @foreach ($areaList as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                                <input wire:model.defer='buildingName'
                                    class="block w-full text-xs rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none"
                                    type="text" placeholder="Add Building" required>
                                <button type="submit" class="bg-indigo-500 text-xs p-1 rounded">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($areaMsg)
                    <h4 class="text-red-500 text-center text-xs mt-2 font-semibold">{{ $areaMsg }}</h4>
                @endif
                @if ($buildingMsg)
                    <h4 class="text-red-500 text-center text-xs mt-2 font-semibold">{{ $buildingMsg }}</h4>
                @endif
            </div>
            <div class="max-w-4xl mx-auto text-xs text-white mt-2">
                <!-- Loop through areas -->
                <div class="grid grid-cols-2 gap-1">
                    <!-- Single Area Block -->
                    @foreach ($areaList as $area)
                        <div class="bg-gray-800 p-2 rounded">
                            <h2 class="text-sm font-semibold border-b border-gray-700 pb-1 mb-2">{{ $area->name }}
                                ({{ $area->building->count() }})
                            </h2>
                            <ul class="flex flex-wrap gap-1">
                                <!-- Loop through sub-areas -->
                                @foreach ($area->building as $building)
                                    <li class="bg-indigo-900 p-1 rounded-md">
                                        {{ $building->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <!-- Repeat the Area Block for more areas -->
                </div>
            </div>
        </div>
        <div class="transactionType w-full">
            <div class="dark:text-white dark:bg-gray-800 bg-white p-3 rounded">
                <h2 class="rounded text-xl font-semibold text-center rtl:text-right text-white">
                    Transaction Types ({{ $transactionType->count() }})
                </h2>
                <div class="mt-6">
                    <form wire:submit.prevent='addTransactionType'>
                        <div class="flex gap-1 w-3/5 mx-auto">
                            <input wire:model.defer='type'
                                class="block w-full text-xs rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none"
                                type="text" placeholder="Add Types" required>
                            <select wire:model.defer='stockImpact'
                                class="block w-full text-xs rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none"
                                required>
                                <option>Stock Impact</option>
                                <option value="1">Ture</option>
                                <option value="0">False</option>
                            </select>
                            <button type="submit" class="bg-indigo-500 text-xs p-1 rounded">Add</button>
                        </div>
                    </form>
                    @if ($typeMsg)
                        <h4 class="text-yellow-500 text-center text-xs mt-2 font-semibold">{{ $typeMsg }}</h4>
                    @endif
                </div>
            </div>
            <div class="bg-gray-800 p-2 rounded text-white text-xs mt-2">
                <ul class="grid grid-cols-3 gap-2">
                    <!-- Loop through sub-areas -->
                    @foreach ($transactionType as $type)
                        <li class="bg-indigo-900 p-1 rounded-md">
                            <span class="flex items-center justify-between gap-1">
                                @if ($type->is_available)
                                    <svg wire:click='avaiableOrNot({{ $type->id }})' class="cursor-pointer"
                                        xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960"
                                        width="16px" fill="#75FB4C">
                                        <path
                                            d="m429-336 238-237-51-51-187 186-85-84-51 51 136 135Zm51 240q-79 0-149-30t-122.5-82.5Q156-261 126-331T96-480q0-80 30-149.5t82.5-122Q261-804 331-834t149-30q80 0 149.5 30t122 82.5Q804-699 834-629.5T864-480q0 79-30 149t-82.5 122.5Q699-156 629.5-126T480-96Zm0-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm0-312Z" />
                                    </svg>
                                @else
                                    <svg wire:click='avaiableOrNot({{ $type->id }})' title="not avaiable"
                                        class="right-4 top-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                                        height="15px" viewBox="0 -960 960 960" width="15px" fill="#EA3323">
                                        <path
                                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                                    </svg>
                                @endif
                                <span>{{ $type->types }}</span>
                                @if ($type->stock_impact)
                                    <svg  wire:click='impactOnStock({{ $type->id }})' class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="18px" fill="#75FB4C"><path d="M288.33-136Q264-136 248-152.15t-16-40.47v-406.76q0-24.32 16.15-40.47T288.62-656H356v-36q0-52.31 34.35-92.15Q424.69-824 480-824q52.31 0 88.15 35.85Q604-752.31 604-700v44h67.38q24.32 0 40.47 16.15T728-599.38v406.76q0 24.32-16.16 40.47T671.34-136H288.33Zm.29-32h382.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-406.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H604v80q0 6.84-4.52 11.42T588.21-528q-6.75 0-11.48-4.58T572-544v-80H388v80q0 6.84-4.52 11.42T372.21-528q-6.75 0-11.48-4.58T356-544v-80h-67.38q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v406.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69ZM388-656h184v-44q0-38.93-26.6-65.47Q518.81-792 479.79-792q-39.02 0-65.41 26.53Q388-738.93 388-700v44ZM264-168v-456 456Z"/></svg>
                                @else
                                    <svg wire:click='impactOnStock({{ $type->id }})' title="not avaiable"
                                        class="right-4 top-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#EA3323"><path d="M480-790.15q34.62 0 60.38 23.07 25.77 23.08 25.77 58.46v22.85q63.39 25.08 100.62 80.62Q704-549.62 704-480v108.62q0 8-5.1 12-5.09 4-10.9 4-5.81 0-10.9-3.84-5.1-3.83-5.1-11.4V-480q0-79.68-56.16-135.84T480-672h-61.85q-12.77 0-22.38-9.61-9.62-9.61-9.62-22.39 6.16-36.15 31.93-61.15t61.92-25Zm0 32q-22.71 0-38.43 15.77-15.72 15.78-15.72 38.56v6.36q12.77-2.77 27.07-4.66Q467.23-704 480-704q12.77 0 27.08 1.88 14.3 1.89 27.07 4.66V-704q0-22.71-15.72-38.43-15.72-15.72-38.43-15.72Zm304.54 643.69L471.54-428h-99.35q-6.92 0-11.55-4.52-4.64-4.52-4.64-11.27t4.58-11.48Q365.16-460 372-460h67.54L316.85-582.69q-15.47 22.61-22.16 49.96-6.69 27.35-6.69 52.26v287.85q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69h334.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-80l32 31v49q0 24.32-16.15 40.47T647.38-136H312.62q-24.32 0-40.47-16.15T256-192.62V-480q0-34 9.65-65.73 9.66-31.73 28.97-59.19l-135-134.46Q154-745 154-750.54t5.62-11.15q6.38-6.39 11.65-6.39 5.27 0 11.65 6.39l624.93 624.92q5.61 5.62 5.61 11.15 0 5.54-5.61 11.16-6.39 6.38-11.66 6.38-5.27 0-11.65-6.38ZM527.62-524.54ZM471.54-428Zm8.46 36.15Z"/></svg>
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
