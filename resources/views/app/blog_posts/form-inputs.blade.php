@php $editing = isset($blogPost) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="blog_id" label="Blog" required>
            @php $selected = old('blog_id', ($editing ? $blogPost->blog_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Blog</option>
            @foreach($blogs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="name" label="Name" maxlength="255" required
            >{{ old('name', ($editing ? json_encode($blogPost->name) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $blogPost->image ? \Storage::url($blogPost->image) : '' }}')"
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
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ?
            json_encode($blogPost->description) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="publish_on"
            label="Publish On"
            value="{{ old('publish_on', ($editing ? optional($blogPost->publish_on)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="priority"
            label="Priority"
            :value="old('priority', ($editing ? $blogPost->priority : '0'))"
            max="255"
            placeholder="Priority"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="published"
            label="Published"
            :checked="old('published', ($editing ? $blogPost->published : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
