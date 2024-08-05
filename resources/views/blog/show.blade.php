<x-app-layout>
	@foreach ($blogs as $blog)
		<div style="padding: 10px; margin-left: 20px;" class="bg-grey font-bold">
			<a href='/show-blogs/{{ $blog->heading }}'>{{ $blog->title  }}</a>
		</div>
	@endforeach
</x-app-layout>
