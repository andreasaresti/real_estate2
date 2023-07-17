@php $editing = isset($listing) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="name" label="Name" maxlength="255" required
            >{{ old('name', ($editing ? json_encode($listing->name) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $listing->image ? \Storage::url($listing->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="parent_id" label="Listing">
            @php $selected = old('parent_id', ($editing ? $listing->parent_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Listing</option>
            @foreach($listings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ?
            json_encode($listing->description) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="price"
            label="Price"
            :value="old('price', ($editing ? $listing->price : ''))"
            max="255"
            step="0.01"
            placeholder="Price"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="old_price"
            label="Old Price"
            :value="old('old_price', ($editing ? $listing->old_price : ''))"
            max="255"
            step="0.01"
            placeholder="Old Price"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="price_prefix"
            label="Price Prefix"
            :value="old('price_prefix', ($editing ? $listing->price_prefix : ''))"
            maxlength="255"
            placeholder="Price Prefix"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="price_postfix"
            label="Price Postfix"
            :value="old('price_postfix', ($editing ? $listing->price_postfix : ''))"
            maxlength="255"
            placeholder="Price Postfix"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="area_size"
            label="Area Size"
            :value="old('area_size', ($editing ? $listing->area_size : ''))"
            max="255"
            placeholder="Area Size"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="area_size_prefix"
            label="Area Size Prefix"
            :value="old('area_size_prefix', ($editing ? $listing->area_size_prefix : ''))"
            maxlength="255"
            placeholder="Area Size Prefix"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="area_size_postfix"
            label="Area Size Postfix"
            :value="old('area_size_postfix', ($editing ? $listing->area_size_postfix : ''))"
            maxlength="255"
            placeholder="Area Size Postfix"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number_of_bedrooms"
            label="Number Of Bedrooms"
            :value="old('number_of_bedrooms', ($editing ? $listing->number_of_bedrooms : ''))"
            max="255"
            placeholder="Number Of Bedrooms"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number_of_bathrooms"
            label="Number Of Bathrooms"
            :value="old('number_of_bathrooms', ($editing ? $listing->number_of_bathrooms : ''))"
            max="255"
            placeholder="Number Of Bathrooms"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number_of_garages_or_parkingpaces"
            label="Number Of Garages Or Parkingpaces"
            :value="old('number_of_garages_or_parkingpaces', ($editing ? $listing->number_of_garages_or_parkingpaces : ''))"
            max="255"
            placeholder="Number Of Garages Or Parkingpaces"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="year_built"
            label="Year Built"
            :value="old('year_built', ($editing ? $listing->year_built : ''))"
            max="255"
            placeholder="Year Built"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="featured"
            label="Featured"
            :checked="old('featured', ($editing ? $listing->featured : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="published"
            label="Published"
            :checked="old('published', ($editing ? $listing->published : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $listing->address : ''))"
            maxlength="255"
            placeholder="Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="latitude"
            label="Latitude"
            :value="old('latitude', ($editing ? $listing->latitude : ''))"
            max="255"
            placeholder="Latitude"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="longitude"
            label="Longitude"
            :value="old('longitude', ($editing ? $listing->longitude : ''))"
            maxlength="255"
            placeholder="Longitude"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="360_virtual_tour"
            label="360 Virtual Tour"
            maxlength="255"
            >{{ old('360_virtual_tour', ($editing ? $listing->360_virtual_tour :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="energy_class"
            label="Energy Class"
            :value="old('energy_class', ($editing ? $listing->energy_class : ''))"
            maxlength="255"
            placeholder="Energy Class"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="energy_performance"
            label="Energy Performance"
            :value="old('energy_performance', ($editing ? $listing->energy_performance : ''))"
            maxlength="255"
            placeholder="Energy Performance"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="epc_current_rating"
            label="Epc Current Rating"
            :value="old('epc_current_rating', ($editing ? $listing->epc_current_rating : ''))"
            maxlength="255"
            placeholder="Epc Current Rating"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="epc_potential_rating"
            label="Epc Potential Rating"
            :value="old('epc_potential_rating', ($editing ? $listing->epc_potential_rating : ''))"
            maxlength="255"
            placeholder="Epc Potential Rating"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="taxes"
            label="Taxes"
            :value="old('taxes', ($editing ? $listing->taxes : ''))"
            maxlength="255"
            placeholder="Taxes"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="dues"
            label="Dues"
            :value="old('dues', ($editing ? $listing->dues : ''))"
            maxlength="255"
            placeholder="Dues"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $listing->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="location_id" label="Location">
            @php $selected = old('location_id', ($editing ? $listing->location_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Location</option>
            @foreach($locations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status_id" label="Status">
            @php $selected = old('status_id', ($editing ? $listing->status_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Status</option>
            @foreach($statuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="delivery_time_id" label="Delivery Time">
            @php $selected = old('delivery_time_id', ($editing ? $listing->delivery_time_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Delivery Time</option>
            @foreach($deliveryTimes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="internal_status_id" label="Internal Status">
            @php $selected = old('internal_status_id', ($editing ? $listing->internal_status_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Internal Status</option>
            @foreach($internalStatuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="owner_id" label="Customer">
            @php $selected = old('owner_id', ($editing ? $listing->owner_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
