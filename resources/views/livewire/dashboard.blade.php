<div>
    <div class="bg-gray-900 p-6 text-white grid grid-cols-2 gap-2">
        <!-- Field Summary -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-100 mb-4">In My Hand</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-900 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-green-300">Good</h3>
                    <div class="grid grid-cols-2">
                        <p class="text-gray-300">Home Cast:</p>
                        <span class="text-right">{{$inMyHand['good']['hc']}}</span>
                        <p class="text-gray-300">New Land:</p>
                        <span class="text-right">{{$inMyHand['good']['nl']}}</span>
                        <p class="text-gray-300 border-t border-t-gray-300">Total:</p>
                        <span class="text-right border-t border-t-gray-300">{{$inMyHand['good']['hc']+$inMyHand['good']['nl']}}</span>
                    </div>
                </div>
                <div class="bg-blue-900 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-red-300">Error</h3>
                    <div class="grid grid-cols-2">
                        <p class="text-gray-300">Home Cast:</p>
                        <span class="text-right">{{$inMyHand['error']['hc']}}</span>
                        <p class="text-gray-300">New Land:</p>
                        <span class="text-right">{{$inMyHand['error']['nl']}}</span>
                        <p class="text-gray-300 border-t border-t-gray-300">Total:</p>
                        <span class="text-right border-t border-t-gray-300">{{$inMyHand['error']['hc']+$inMyHand['error']['nl']}}</span>
                    </div>
                </div>
                <!-- Add more field summaries as needed -->
            </div>
        </div>
        <!-- Vendor Summary -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 ">
            <h2 class="text-2xl font-semibold text-gray-100 mb-4">In Stock</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-indigo-900 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-green-300">Good</h3>
                    <div class="grid grid-cols-2">
                        <p class="text-gray-300">Home Cast:</p>
                        <span class="text-right">{{$stock['good']['hc']}}</span>
                        <p class="text-gray-300">New Land:</p>
                        <span class="text-right">{{$stock['good']['nl']}}</span>
                        <p class="text-gray-300 border-t border-t-gray-300">Total:</p>
                        <span class="text-right border-t border-t-gray-300">{{$stock['good']['hc']+$stock['good']['nl']}}</span>
                    </div>
                </div>
                <div class="bg-indigo-900 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-red-300">Error</h3>
                    <div class="grid grid-cols-2">
                        <p class="text-gray-300">Home Cast:</p>
                        <span class="text-right">{{$stock['error']['hc']}}</span>
                        <p class="text-gray-300">New Land:</p>
                        <span class="text-right">{{$stock['error']['nl']}}</span>
                        <p class="text-gray-300 border-t border-t-gray-300">Total:</p>
                        <span class="text-right border-t border-t-gray-300">{{$stock['error']['hc']+$stock['error']['nl']}}</span>
                    </div>
                </div>
                <!-- Add more vendor summaries as needed -->
            </div>
        </div>
    </div>


</div>
