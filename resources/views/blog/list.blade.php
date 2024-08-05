<x-app-layout>
	<div style="margin-top:10px">
		<a style="padding: 3px; margin:10px; border:3px; border-style:solid" href={{ url('/show-blogs') }}>Go Back</a>
	</div>
	<br>
		<div style="margin: 10px;font-size: 2em;" class="font-bold">
			{{$blog->title}} 
		</div>
	<p style="margin: 10px; font-style: italic;" class="text-gray-600 "> Written by {{ $blog->user->name}} on {{$blog->created_at->format('j M Y, g:i a') }} </p>
	<br>
	<p style="margin: 10px;"> {{$blog->content}} </p>
	<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
	<form method="post" action="{{ route('blog-comment', $blog) }}">
		@csrf	
		<input type="hidden" name="testStuff" value="{{$blog->id}}"></input>	
		<textarea name="message" style="border-radius: 10px; padding: 6px; margin-left: 15px;"placeholder="{{('Write a comment here!')}}"></textarea>
		<x-primary-button type="submit">Submit</x-primary-button>
	<div style="margin-left: 25px;">
		@for ($i = count($comments)-1; $i >= 0; $i--)
			<p> {{$comments[$i]->message}} </p>
			<p> from: {{$comments[$i]->user->name}} </p>
			<br>
		@endfor
	</div>
</x-app-layout>
