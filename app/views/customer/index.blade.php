@extends('template.master')
@section('content')
    <div id="pad-wrapper">
        <div class="row ">
            <table id="customer-table" class="table table-stripped table-responsive">
                <thead>
                    <tr>
                        <td data-class="expand"><strong>Name</strong></td>
                        <td data-hide="phone"><strong>Address</strong></td>
                        <td data-hide="phone"><strong>Last Visit</strong></td>
                        <td data-hide="phone"><strong>Phone</strong></td>
                        <td data-hide="phone"><strong>Email</strong></td>
                        <td data-hide="phone"><strong>Action</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" style="text-align:center">No data available!</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8"><a href="{{URL::to('customer/create')}}" class="btn-flat success" id="btn-customer-add">+ Add New Customer</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @include('customer.create-modal')
    @include('customer.preview-modal')
@stop