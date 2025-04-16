<div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">

    <!-- Form Container -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <div class="relative mb-4">
{{--            <a href="{{ route('room-sample.show', $roomSample) }}"--}}
{{--               class="btn btn-secondary py-2 absolute left-0 top-1/2 -translate-y-1/2">--}}
{{--                Back--}}
{{--            </a>--}}
            <h2 class="text-2xl font-semibold text-center">
                {{ isset($roomSample) ? 'Edit Room Sample' : 'Create Room Sample' }}
            </h2>
        </div>

        <form id="roomSampleForm" class="grid grid-cols-2 gap-6" autocomplete="off">
            @csrf

            <!-- Left Column: Basic Fields -->
            <div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="form-input w-full p-2 border rounded-md"
                           required value="{{ $roomSample->name ?? '' }}">
                </div>

                <div class="mb-4">
                    <label for="person_count" class="block text-sm font-medium text-gray-700">Person Count</label>
                    <input type="number" id="person_count" name="person_count" min="1"
                           class="form-input w-full p-2 border rounded-md" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           value="{{ $roomSample->person_count ?? '' }}">
                </div>

                <div class="mb-4">
                    <label for="square_area" class="block text-sm font-medium text-gray-700">Square Area
                        (m²)</label>
                    <input type="number" id="square_area" name="square_area" min="1"
                           class="form-input w-full p-2 border rounded-md" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           value="{{ $roomSample->square_area ?? '' }}">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" min="1"
                           class="form-input w-full p-2 border rounded-md" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           value="{{ $roomSample->price ?? '' }}">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description"
                              class="form-input w-full p-2 border rounded-md">{{ $roomSample->description ?? '' }}</textarea>
                </div>
            </div>

            <!-- Right Column: Image Upload -->
            <div class="flex flex-col items-center w-full">
                <label class="block text-sm font-medium text-gray-700 mb-2">Room Image</label>

                <!-- Image Box -->
                @php
                    $hasImage = (bool)isset($roomSample) ?? $roomSample->image_path
                @endphp
                <div
                        class="relative w-full h-72 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">
                    <img id="imagePreview"
                         src="{{ isset($roomSample) ? route('room-sample.image', $roomSample) : "" }}"
                         alt="Room Image" class="w-full h-full object-cover {{$hasImage ? "" : "hidden"}}">
                    <span id="placeholderText"
                          class="text-gray-400 {{$hasImage ? "hidden" : ""}}">No image selected</span>
                </div>

                <!-- Buttons in one row -->
                <div class="mt-3 flex w-full gap-2">
                    <button type="button" id="uploadButton"
                            class="btn btn-primary px-4 py-2 bg-primary text-white rounded-md w-full">Choose Image
                    </button>
                    <button type="button" id="removeButton"
                            class="btn btn-error px-3 py-2 text-white rounded-md hidden">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>

                <input type="file" id="image" name="image" accept="image/*" class="hidden">
            </div>

            <!-- Room Parameters Block (One Column Below) -->
            <div class="mt-6">
                <label class="block text-lg font-semibold text-gray-700">Room Parameters</label>
                <div id="roomParametersContainer" class="mt-2">
                    @if($roomSample && $roomSample->roomParameters)
                        @foreach($roomSample->roomParameters as $param)
                            @include('components.roomParameterTemplate', ['parameter' => $param])
                        @endforeach
                    @endif
                </div>

                <!-- Прихований шаблон для використання в JS -->
                <div id="roomParameterTemplate" class="hidden">
                    @include('components.roomParameterTemplate')
                </div>

                <button type="button" id="addParameterButton" class="mt-2 px-4 py-2 border rounded-md bg-gray-200">+
                    Add
                    Parameter
                </button>
            </div>

            <!-- Save Button -->
            <div class="col-span-2 mt-6">
{{--                <button type="button" id="saveButton" class="btn btn-primary w-full py-2 rounded-md" disabled--}}
{{--                        data-url="{{$buttonUrl}}" data-method="{{$buttonMethod}}">--}}
{{--                    {{$buttonLabel}}--}}
{{--                </button>--}}
                <div class="flex items-center gap-4 mt-6">
                    <!-- Back Button -->
                    <a href="{{ url()->previous() }}"
                       class="btn btn-secondary py-2 px-4 flex-shrink-0">
                        Back
                    </a>

                    <!-- Save Button -->
                    <button type="button" id="saveButton"
                            class="btn btn-primary py-2 px-6 rounded-md w-full"
                            data-url="{{$buttonUrl}}" data-method="{{$buttonMethod}}" disabled>
                        {{$buttonLabel}}
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script src="{{ asset('js/roomSamples/roomSampleForm.js') }}"></script>
<script src="{{ asset('js/roomSamples/roomSampleTags.js') }}"></script>
