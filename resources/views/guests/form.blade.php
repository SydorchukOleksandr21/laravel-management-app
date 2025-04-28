@props(['buttonMethod', 'buttonLabel', 'buttonUrl', 'model' => null])

<x-form.form
    :isEdit="intval(isset($model))"
    :labelEdit="__('property.guest.edit')"
    :labelCreate="__('property.guest.create')"
    :action="$buttonUrl"
    :method="$buttonMethod"
>

    {{-- Name --}}
    <x-form.input
        :item="$model"
        property="name"
        type="text"
        required
        label="{{ __('property.guest.name') }}"
        placeholder="John Doe"
    />

    <x-form.phone
        :item="$model"
        property="phone_number"
        required
        label="{{ __('property.guest.phone_number') }}"
    />

    {{-- Email --}}
    <x-form.input
        :item="$model"
        property="email"
        type="email"
        required
        label="{{ __('property.guest.email') }}"
        placeholder="you@example.com"
    />

</x-form.form>


@push('scripts')
    <script src="{{ asset('js/components/phoneNumberComponent.js') }}"></script>
    <script src="{{ asset('js/components/requiredFieldsButtonActivation.js') }}" defer></script>
@endpush
