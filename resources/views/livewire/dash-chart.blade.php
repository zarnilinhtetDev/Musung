<div wire:poll.20000ms>
    {{ $percent_chart->container() }}


    {!! $percent_chart->script() !!}
</div>
@push('scripts')
<script src="{{ $percent_chart->cdn() }}"></script>

@endpush
