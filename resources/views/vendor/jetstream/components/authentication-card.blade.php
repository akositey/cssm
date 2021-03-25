<div class="min-h-screen bg-gray-100 ">
    <div class="block w-full p-4 font-bold text-center bg-white">
        <h2 class="text-xl align-center">PGOM - Customer Satisfaction Survey</h2>
    </div>

    <div class="flex flex-col items-center max-h-screen pt-2 sm:justify-center sm:pt-0">
        <div class="block ">
            {{ $logo }}
        </div>
        <div class="w-full px-6 py-4 mt-2 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
