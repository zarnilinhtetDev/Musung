<div wire:poll.1000ms>
    hello
    {!! $percent_chart->container() !!}
</div>

@push('scripts')
<script src="{{ $percent_chart->cdn() }}"></script>
{!! $percent_chart->script() !!}
@endpush
