<x-app-layout>
	<div style="padding: 6px;" class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
		<form method="POST" action="{{ route('blog.store') }}">
			@csrf
			<input type="text" name="title" placeholder="{{ __('Blog Title') }}" style="border-width: 3px; margin:4px; padding: 6px;"class="block w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" ></input>
			
			<textarea name="content" placeholder="{{ __('Write your blog. Go wild!') }}" style="border-width: 3px;height: 150px; margin:4px; padding: 6px;" class="block w-full  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" >{{ old('content') }}</textarea>
			
			<x-primary-button class="mt-4">{{ __('Submit') }}</x-primary-button>
			<br>
			<x-input-error :messages="$errors->get('title')" class="mt-2" style="font-size: 1em;" />
			<x-input-error :messages="$errors->get('content')" class="mt-2" style="font-size: 1em;"/>
		</form>
		@if (Session::get('errorMsg'))
			<h1 style="color: #ee0000;">  {{Session::get('errorMsg') }} </h1>
		@endif
	</div>
</x-app-layout>
