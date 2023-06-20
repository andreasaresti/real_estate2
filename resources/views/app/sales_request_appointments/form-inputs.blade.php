@php $editing = isset($salesRequestAppointment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="listing_id" label="Listing" required>
            @php $selected = old('listing_id', ($editing ? $salesRequestAppointment->listing_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Listing</option>
            @foreach($listings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($salesRequestAppointment->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
