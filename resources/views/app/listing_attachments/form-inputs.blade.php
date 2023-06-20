@php $editing = isset($listingAttachment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="listing_id" label="Listing" required>
            @php $selected = old('listing_id', ($editing ? $listingAttachment->listing_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Listing</option>
            @foreach($listings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $listingAttachment->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="attachment"
            label="Attachment"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="attachment"
            id="attachment"
            class="form-control-file"
        />

        @if($editing && $listingAttachment->attachment)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($listingAttachment->attachment) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('attachment') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>
