@extends('template.master')
@section('content')
    <div id="pad-wrapper">
        <div class="row ">
            <table id="offer-table" class="table table-stripped table-responsive">
                <thead>
                    <tr>
                        <td data-class="expand"><strong>Image</strong></td>
                        @if($global['isAdmin'])<td><strong>Company Name</strong></td>@endif
                        <td @if($global['isAdmin']) data-hide="phone" @endif><strong>Description</strong></td>
                        <td data-hide="phone"><strong>$ Sales</strong></td>
                        <td data-hide="phone"><strong># Purchased</strong></td>
                        <td data-hide="phone"><strong>Date</strong></td>
                        <td data-hide="phone"><strong>Status</strong></td>
                        <td data-hide="phone"><strong>Action</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" style="text-align:center">No data available!</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7"><a href="{{URL::to('offer/create')}}" class="btn-flat success" id="btn-add">+ Create New Offer</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @include('offer.preview-modal')
@stop