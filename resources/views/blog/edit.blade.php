<x-app-layout>
	<form method="POST" action="{{ route('blog.update', $blog) }}">
		@csrf
		@method('patch')
		<textarea style="padding: 6px; margin: 20px; width:900px; height:300px;"name="content">{{ old('content', $blog->content) }}</textarea>
		<x-input-error :messages="$errors->get('content')" />
		<br>
		<x-primary-button style="margin-left:20px;">{{ __('Save Blog') }}</x-primary-button>
		<a style="margin-left: 10px; text-decoration:underline; font-style:italic" href='/show-blogs/{{ $blog->heading }}'>Cancel</a>
	</form>
</x-app-layout>
