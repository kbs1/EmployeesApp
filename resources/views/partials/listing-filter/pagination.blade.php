@if ($paginator->hasPages())
	<nav>
		<ul class="pagination justify-content-end">
			@foreach ($elements as $element)
				@if (is_string($element))
					<li class="page-item disabled">
						<a href="#" class="page-link" tabindex="-1" aria-disabled="true">{{ $element }}</a>
					</li>
				@endif

				@if (is_array($element))
					@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<li class="page-item active" aria-current="page">
								<a href="#" class="page-link" onclick="return false">{{ $page }}</a>
							</li>
						@else
							<li class="page-item">
								<a href="{{ $url }}" class="page-link">{{ $page }}</a>
							</li>
						@endif
					@endforeach
				@endif
			@endforeach
		</ul>
	</nav>
@endif