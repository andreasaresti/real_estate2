@php $editing = isset($blog) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="name" label="Name" maxlength="255" required
            >{{ old('name', ($editing ? json_encode($blog->name) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="active"
            label="Active"
            :checked="old('active', ($editing ? $blog->active : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
