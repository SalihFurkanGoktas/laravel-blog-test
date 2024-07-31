   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <script src="{{ asset('js/app.js') }}" defer></script>
<x-app-layout>
	<div>
		<a href={{ url()->previous() }}>Go Back</a>
	</div>
	<br>
		<div class="tw-text-lg md:tw-text-xl tw-bg-red-500 hover:tw-bg-blue-500">
		 {{$blog->title}} 
		</div>
	<br>
		<p> Written by {{ $blog->user->name}} on {{$blog->created_at->format('j M Y, g:i a') }} </p>
	<br>
		<ap> {{$blog->content}} </p>
	<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
</x-app-layout>
