<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.blog_posts.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\BlogPost::class)
                            <a
                                href="{{ route('blog-posts.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.blog_posts.inputs.blog_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.blog_posts.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.blog_posts.inputs.image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.blog_posts.inputs.description')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.blog_posts.inputs.publish_on')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.blog_posts.inputs.priority')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.blog_posts.inputs.published')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($blogPosts as $blogPost)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($blogPost->blog)->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($blogPost->name) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $blogPost->image ? \Storage::url($blogPost->image) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($blogPost->description) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $blogPost->publish_on ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $blogPost->priority ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $blogPost->published ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $blogPost)
                                        <a
                                            href="{{ route('blog-posts.edit', $blogPost) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $blogPost)
                                        <a
                                            href="{{ route('blog-posts.show', $blogPost) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $blogPost)
                                        <form
                                            action="{{ route('blog-posts.destroy', $blogPost) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="mt-10 px-4">
                                        {!! $blogPosts->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
