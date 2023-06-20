@php $editing = isset($salesRequestListing) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="listing_id" label="Listing" required>
            @php $selected = old('listing_id', ($editing ? $salesRequestListing->listing_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Listing</option>
            @foreach($listings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $salesRequestListing->status : '')) @endphp
            <option value="open" {{ $selected == 'open' ? 'selected' : '' }} >Open</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $salesRequestListing->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="active"
            label="Active"
            :checked="old('active', ($editing ? $salesRequestListing->active : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
