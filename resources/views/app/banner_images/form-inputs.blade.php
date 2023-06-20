@php $editing = isset($bannerImage) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="banner_id" label="Banner" required>
            @php $selected = old('banner_id', ($editing ? $bannerImage->banner_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Banner</option>
            @foreach($banners as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $bannerImage->image ? \Storage::url($bannerImage->image) : '' }}')"
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
        <x-inputs.textarea name="name" label="Name" maxlength="255"
            >{{ old('name', ($editing ? json_encode($bannerImage->name) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ?
            json_encode($bannerImage->description) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="button_text"
            label="Button Text"
            maxlength="255"
            >{{ old('button_text', ($editing ?
            json_encode($bannerImage->button_text) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="link"
            label="Link"
            :value="old('link', ($editing ? $bannerImage->link : ''))"
            maxlength="255"
            placeholder="Link"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="language_id" label="Language">
            @php $selected = old('language_id', ($editing ? $bannerImage->language_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Language</option>
            @foreach($languages as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="active"
            label="Active"
            :checked="old('active', ($editing ? $bannerImage->active : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
