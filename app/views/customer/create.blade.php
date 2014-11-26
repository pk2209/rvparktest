@extends('template.master')
@section('content')
<div id="pad-wrapper">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12" style="margin-bottom:40px">
            <h3>Customer Detail</h3>
        </div>
    </div>
    @if(Session::get('message', false))
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-{{Session::get('class')}}">
                    {{Session::get('message')}}.
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            @include('customer.form')
        </div>
    </div>
</div>
@stop