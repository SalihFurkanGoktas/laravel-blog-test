<x-app-layout>
	@foreach ($blogs as $blog)
		<div style="border-bottom: 1px solid #00bbbb; padding: 10px; margin: 5px 20px 5px 20px;" class="bg-grey font-bold">
			<a style="font-size:1.5em;" class="hover:text-gray-500" href='/show-blogs/{{ $blog->heading }}'>{{ $blog->title  }}</a>
		</div>
	@endforeach

	{{ $blogs->links() }}
</x-app-layout>
