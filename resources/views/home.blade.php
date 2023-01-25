@extends('layouts.app')

@section('content')
@php
// $hash = Hash::make('1111');
// echo $hash;
@endphp
@section('content_2')


@LiveTV
<script type="text/javascript">
    window.location = "{{url('live_dash')}}";
</script>
@endLiveTV

@viewer
<script type="text/javascript">
    window.location = "{{url('live_dash')}}";
</script>
@endviewer

@superadmin
<script type="text/javascript">
    window.location = "{{url('menu')}}";
</script>
@endsuperadmin

@owner
<script type="text/javascript">
    window.location = "{{url('menu')}}";
</script>
@endowner

@admin
<script type="text/javascript">
    window.location = "{{url('live_dash')}}";
</script>
@endadmin

@operator
<script type="text/javascript">
    window.location = "{{url('/line_setting')}}";
</script>
@endoperator

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager
@endsection

@endsection
