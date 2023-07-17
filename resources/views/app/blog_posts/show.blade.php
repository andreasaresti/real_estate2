<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.blog_posts.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('blog-posts.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.blog_id')
                        </h5>
                        <span
                            >{{ optional($blogPost->blog)->name ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.name')
                        </h5>
                        <pre>{{ json_encode($blogPost->name) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $blogPost->image ? \Storage::url($blogPost->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.description')
                        </h5>
                        <pre>
{{ json_encode($blogPost->description) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.publish_on')
                        </h5>
                        <span>{{ $blogPost->publish_on ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.priority')
                        </h5>
                        <span>{{ $blogPost->priority ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.blog_posts.inputs.published')
                        </h5>
                        <span>{{ $blogPost->published ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('blog-posts.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\BlogPost::class)
                    <a href="{{ route('blog-posts.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
