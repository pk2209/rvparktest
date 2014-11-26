@extends('template.master')
@section('content')
<div id="pad-wrapper">
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
            <h3>Create New Appointment</h3>
        </div>
    </div>
    @include('calendar.form')
</div>
@stop