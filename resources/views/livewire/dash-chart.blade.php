<div wire:poll.20000ms>
    <h2 class="fw-bold pt-2">Target and Output Chart</h2>
    {{ $percent_chart->container() }}


    {!! $percent_chart->script() !!}
</div>
@push('scripts')
<script src="{{ $percent_chart->cdn() }}"></script>

@endpush
