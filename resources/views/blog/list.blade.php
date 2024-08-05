<x-app-layout>
	<div style="margin-top:10px">
		<a style="padding: 3px; margin:10px 3px 10px 3px; border:3px; border-style:solid" href={{ url('/show-blogs') }}>Go Back</a>
		@if ($blog->user->is(auth()->user()))
			<a style="padding: 3px; margin:10px 3px 10px 3px; border:3px; border-style:solid" href={{ route('blog.edit', $blog) }}>Edit Blog</a>
			<form style="margin-top:10px" method="POST" action="{{route('blog.destroy', $blog) }}">
				@csrf
				@method('delete')
				<a style="padding: 3px; margin:30px 3px 10px 3px; border:3px solid red; color: #cc0000;" href={{ route('blog.destroy', $blog) }} onclick="event.preventDefault(); this.closest('form').submit();">Delete Blog</a>
			</form>
		@endif
	</div>
	<br>

	@if (Session::get('editPosted'))
		<p style="color: #61de4e; margin-left: 15px"> Edit saved! </p>
	@endif

	<div style="margin: 10px;font-size: 2em;" class="font-bold">
		{{$blog->title}} 
	</div>
	
	<p style="margin: 10px; font-style: italic;" class="text-gray-600 "> Written by {{ $blog->user->name}} on {{$blog->created_at->format('j M Y, g:i a') }}
	@if ($blog->created_at != $blog->updated_at)
		- Edited at {{$blog->updated_at->format('j M Y, g:i a') }}
	@endif
	</p>	
	<br>
	<p style="margin-left: 10px; margin-right: 100px;"> {{$blog->content}} </p>
	<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

	<form method="post" style="margin-left:15px;"action="{{ route('blog-comment', $blog) }}">
		@csrf	

		<input type="hidden" name="testStuff" value="{{$blog->id}}"></input>	
		<textarea name="message" style="border-radius: 10px; padding: 6px; "placeholder="{{('Write a comment here!')}}"></textarea>
		<br>
		<x-primary-button style="margin-top: 5px;" type="submit">Submit</x-primary-button>

		<!-- Display of either error message or successful posting message, depending on.. well, whether is succesfully posts. -->
		<x-input-error :messages="$errors->get('message')" class="mt-2" style="font-size: 1em;" />
		@if (Session::get('commentPosted'))
			<p style="color: #61de4e;"> Comment saved! </p>
		@endif
	</form>

	<div style="margin-left: 10px;">
		<ul style="display: flex; flex-wrap: wrap;" >
		@for ($i = count($comments)-1; $i >= 0; $i--)
			<li style="max-width:400px; word-wrap:break-word; border-radius: 5px; border: 2px solid #28a99e; margin: 5px; padding: 3px;"> 
				{{$comments[$i]->message}}
				<br> 
				<p style="border-top: 1px solid #7a807c; color: #7a807c;"> From: {{$comments[$i]->user->name}} 
				<br>
				At: {{$comments[$i]->created_at->format('j M Y, g:i a')}} </p>
			</li>
		@endfor
		</ul>
	</div>
	<br>
</x-app-layout>
