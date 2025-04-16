<div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">
    <!-- View Container -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-center">
                {{$title}}
            </h2>
        </div>

        {{ $slot }}

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-between">
            <a href="{{$urlEdit}}"
               class="btn btn-secondary py-2">Edit</a>
            <button onclick="openModal('{{ $urlDelete, $itemId }}')"
                    class="btn btn-error py-2">
                Delete
            </button>
        </div>
    </div>

    @include('components.confirmModal')
</div>
