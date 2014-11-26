@extends('template.master')
@section('content')
<div id="pad-wrapper">
    <div class="row calendar-wrapper">
        <div class="col-md-2 col-sm-3 calendar_sidebar">
            <div class="eventlist">
                <div class="clockbox">
                    <span class="clockblock" id="clock"></span>
                    <span class="ampmblock" id="ampm"></span>
                </div>
                <div class="datebox">
                    <span class="dateblock" id="day"></span>
                    <span class="dateblock" id="date"></span>
                </div>
                <div class="eventbox">
                    <table>
                        <tr>
                            <td style="width:20%">
                                <span class="confirmed_event">{{$appointment['confirmed']}}</span>
                            </td>
                            <td class="text-right">
                                <span class="confirmed_event">Confirmed</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%">
                                <span class="canceled_event">{{$appointment['canceled']}}</span>
                            </td>
                            <td class="text-right">
                                <span class="canceled_event">Canceled</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%">
                                <span class="noreply_event">{{$appointment['noreply']}}</span>
                            </td>
                            <td class="text-right">
                                <span class="noreply_event">No Reply</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div>
                <a href="{{URL::to('calendar/create')}}" class="btn btn-block btn-primary" id="appointment_create">Create Appointment</a>
            </div>
        </div>
        <div class="col-md-10 col-sm-9">
            <div id="calendar" class="fc fc-ltr"></div>
        </div>

        <!-- appointment popup -->
        <div class="new-event popup hide" id="instant_appointment">
            <form action="{{URl::to('calendar')}}" method="POST" id="instant_appointment_form">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <i class="close-pop table-delete" id="close_instant_appointment"></i>
                <h5>New Calendar Event</h5>
                <div class="field">
                    When:
                    <span class="date text-bold" id="instant_appointment_period"></span>
                    <input type="hidden" name="DateStart" id="instant_appointment_start">
                    <input type="hidden" name="DateEnd" id="instant_appointment_end">
                </div>
                <div class="field">
                    What:
                    <input type="text" name="Title" class="event-input form-control" id="instant_appointment_title">
                </div>
                <input type="submit" class="btn-glow primary" id="instant_appointment_save" value="Create">
            </form>
        </div>

        <!-- appointment preview popup -->
        <div class="preview-event popup hide" id="preview_appointment">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <i class="close-pop table-delete" id="close_preview_appointment"></i>
                <h4 id="preview_appointment_title" style="margin-bottom: 15px; font-weight:bold"></h4>
                <div class="field" id="preview_appointment_date">
                    <i class="icon-calendar"></i>
                    <span class="date text-bold"></span>
                </div>
                <div class="field" id="preview_appointment_time">
                    <i class="icon-time"></i>
                    <span class="date text-bold"></span>
                </div>
                <div class="field" id="preview_appointment_note">
                    <i class="icon-comment"></i>
                    <span class="date"></span>
                </div>
                <div class="field">
                    <button class="btn-glow default pull-left" id="preview_appointment_delete">Delete</button>
                    <a class="btn-glow primary pull-right" id="preview_appointment_edit" href="#">Edit</a>
                </div>
        </div>


        <!-- appointment modal -->
        @include("calendar.appointment-modal")
    </div>
</div>
@stop