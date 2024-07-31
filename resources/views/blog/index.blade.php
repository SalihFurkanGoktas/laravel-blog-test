<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('blog.store') }}">
            @csrf
            <input 
		type="text"
                name="title"
                placeholder="{{ __('Blog Title') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('title') }}</input>

            <textarea
                name="content"
                placeholder="{{ __('Write your blog. Go wild!') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('content') }}</textarea>

            <x-primary-button class="mt-4">{{ __('Submit') }}</x-primary-button>
        </form>
	<br>
	@php
		if (null !== Session::get('errorMsg'))
			echo "<h1 style=\"color: #ee0000;\">" . Session::get('errorMsg') . "</h1>";
	@endphp
    </div>
</x-app-layout>
