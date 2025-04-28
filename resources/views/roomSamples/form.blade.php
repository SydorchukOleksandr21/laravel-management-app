<div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">
    <!-- Form Container -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <div class="relative mb-4">
            <h2 class="text-2xl font-semibold text-center">
                {{ isset($model) ? __('property.room_sample.edit') : __('property.room_sample.create') }}
            </h2>
        </div>


        <form id="submitForm" class="grid grid-cols-1 md:grid-cols-2 gap-6" autocomplete="off">
            @csrf

            <!-- Left Column: Basic Fields -->
            <div class="space-y-4">
                <x-form.input :item="$model" property="name" type="text" required />
                <x-form.input :item="$model" property="person_count" type="number" min="1" required />
                <x-form.input :item="$model" property="square_area" type="number" min="1" required />
                <x-form.input :item="$model" property="price" type="number" min="1" required />
                <x-form.input :item="$model" property="description" type="textarea" />
            </div>

            <!-- Right Column: Image Upload -->
            <div class="space-y-4 flex flex-col w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Room Image</label>
                    @php
                        $hasImage = isset($model) && $model->image_path;
                        $imageSrc = $hasImage ? route("image.show", [
                            'modelName' => class_basename($model),
                            'modelId' => $model,
                            'property' => 'image_path'
                        ]) : '';
                    @endphp
                    <div class="relative w-full h-72 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">
                        <img id="imagePreview" src="{{ $imageSrc }}" alt="Room Image" class="w-full h-full object-cover {{ $hasImage ? '' : 'hidden' }}">
                        <span id="placeholderText" class="text-gray-400 {{ $hasImage ? 'hidden' : '' }}">No image selected</span>
                    </div>
                </div>

                <!-- Image Buttons -->
                <div class="flex w-full gap-2">
                    <button type="button" id="uploadButton" class="btn btn-primary w-full">Choose Image</button>
                    <button type="button" id="removeButton" class="btn btn-error hidden">
                        <x-icon name="trash" class="w-5 h-5" />
                    </button>
                </div>

                <input type="file" id="image" name="image" accept="image/*" class="hidden">
            </div>

            <!-- Room Parameters -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-lg font-semibold text-gray-700">Room Parameters</label>

                <div id="roomParametersContainer" class="mt-2">
                    @if($model && $model->roomParameters)
                        @foreach($model->roomParameters as $param)
                            @include('components.roomParameterTemplate', ['parameter' => $param])
                        @endforeach
                    @endif
                </div>

                <!-- Template for JavaScript use -->
                <div id="roomParameterTemplate" class="hidden">
                    @include('components.roomParameterTemplate')
                </div>

                <button type="button" id="addParameterButton" class="mt-2 btn btn-secondary">+ Add Parameter</button>
            </div>

            <!-- Action Buttons -->
            <div class="col-span-1 md:col-span-2 mt-6">
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary w-full md:w-auto">Back</a>
                    <button type="button" id="saveButton"
                            class="btn btn-primary w-full md:flex-1"
                            data-url="{{ $buttonUrl }}"
                            data-method="{{ $buttonMethod }}" disabled>
                        {{ $buttonLabel }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/components/requiredFieldsButtonActivation.js') }}"></script>
    <script src="{{ asset('js/roomSamples/roomSampleForm.js') }}"></script>
    <script src="{{ asset('js/roomSamples/roomSampleTags.js') }}"></script>
@endpush
