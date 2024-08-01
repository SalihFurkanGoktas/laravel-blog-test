<x-app-layout>
	<div>
		<a href={{ url()->previous() }}>Go Back</a>
	</div>
	<br>
		<div class="text-2xl font-bold">
			{{$blog->title}} 
		</div>
	<br>
	<p class="text-gray-500"> Written by {{ $blog->user->name}} on {{$blog->created_at->format('j M Y, g:i a') }} </p>
	<br>
	<p> {{$blog->content}} </p>
	<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
</x-app-layout>
