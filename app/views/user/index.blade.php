@extends('template.master')
@section('content')
    <div id="pad-wrapper">
        <div class="row ">
            <table id="provider-table" class="table table-stripped table-responsive">
                <thead>
                    <tr>
                        <td data-class="expand"><strong>Company's Name</strong></td>
                        <td data-hide="phone"><strong>Services</strong></td>
                        <td data-hide="phone"><strong>SignUp Date</strong></td>
                        <td><strong>Status</strong></td>
                        <td data-hide="phone"><strong>Action</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" style="text-align:center">No data available!</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><a href="{{URL::to('admin/provider/create')}}" class="btn-flat success" id="btn-provider-add">+ Create User</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop