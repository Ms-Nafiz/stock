<div>
    <div class="p-4">
        <div class="w-">
            {{-- <h2 class="text-base my-2 font-semibold">Search by NUID</h2> --}}
            <form wire:submit.prevent='editStb'>
                <input wire:model.defer='nuid' minlength="10" id="email" name="email"
                    type="text" required
                    class="block w-full rounded-md border border-indigo-400 p-1 text-gray-900 shadow-sm placeholder:text-gray-400 outline-none sm:text-sm sm:leading-6">
                <button type="submit"
                    class="w-full mt-2 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update
                </button>
            </form>
            @if ($msg)
                <div class="text-center">
                    <span
                        class="items-center w-full rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10 my-2 block">{{ $msg }}
                    </span>
                </div>
            @endif
        </div>
    </div>
