@extends('template.master')
@section('content')
    <div id="main-stats">
        <div class="row stats-row">
            <div class="col-md-3 col-sm-3 stat">
                <div class="data">
                    <span class="number">{{$offer_count}}</span>
                    @if($offer_count > 1) Offers @else Offer @endif
                </div>
                <!--<span class="date">Today</span>-->
            </div>
            <div class="col-md-3 col-sm-3 stat">
                <div class="data">
                    <span class="number">0</span>
                    Users
                </div>
                <span class="date">{{date('M Y')}}</span>
            </div>
            <div class="col-md-3 col-sm-3 stat">
                <div class="data">
                    <span class="number">0</span>
                    Order
                </div>
                <span class="date">This week</span>
            </div>
            <div class="col-md-3 col-sm-3 stat last">
                <div class="data">
                    <span class="number">0</span>
                    Sales
                </div>
                <span class="date">last 30 days</span>
            </div>
        </div>
    </div>

    <div id="pad-wrapper">
        <div class="row">
            <div class="col-md-12 center" style="margin-top:20px; margin-bottom: 30px">
                <h1 style="margin:20px auto">Welcome!</h1>
                <h1 style="margin:20px auto">Post an Offer to attract Pet Parents</h1>

                <a href="{{URL::to('offer/create')}}" class="btn btn-glow primary">Post Offer Now!</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    <h4><i class="icon-calendar"></i> What's on Today</h4>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-md-4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop