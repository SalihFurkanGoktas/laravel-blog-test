<x-app-layout>
	@foreach ($blogs as $blog)
		<div class="p-6 bg-grey font-bold">
			<a href='/show-blogs/{{ $blog->heading }}'>{{ $blog->title  }}</a>
		</div>
	@endforeach
</x-app-layout>
