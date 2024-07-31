
@if (Auth::check())
<x-app-layout>
@foreach ($blogs as $blog)
	<a href='/show-blogs/{{ $blog->heading }}'>{{ $blog->title  }}</a>
	<br>
@endforeach
</x-app-layout>
@else

@foreach ($blogs as $blog)
	<a href='/show-blogs/{{ $blog->heading }}'>{{ $blog->title  }}</a>
	<br>
@endforeach

@endif


