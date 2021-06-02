@if ($paginator->hasPages())
	<nav>
		<ul class="flex items-center justify-center mt-4">
			{{-- Pagination Elements --}}
			@foreach ($elements as $element)
				{{-- "Three Dots" Separator --}}
				@if (is_string($element))
					<li class="text-sm mx-1" aria-disabled="true"><span>{{ $element }}</span></li>
				@endif

				{{-- Array Of Links --}}
				@if (is_array($element))
					@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<li aria-current="page" class="mx-1">
								<a href="#" onclick="return false" class="font-bold text-sm text-black">{{ $page }}</a>
							</li>
						@else
							<li class="mx-1"><a href="{{ $url }}" class="font-bold text-sm text-blue">{{ $page }}</a></li>
						@endif
					@endforeach
				@endif
			@endforeach
		</ul>
	</nav>
@endif
