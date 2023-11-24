@if (request()->date != null)
    "date" : "{{ request()->date }}",
@else
    "date" : null,
@endif

@if (request()->status != null)
    "status" : "{{ request()->status }}",
@else
    "status" : null,
@endif
