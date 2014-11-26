@extends('template.master')
@section('content')
    <div id="pad-wrapper" class="form-page">
        <div class="row-fluid">
            @if(Session::get('status') && Session::get('status') == 'success')
            <div class="col-md-8">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> {{Session::get('message')}}
                </div>
            </div>
            @elseif(Session::get('status') && Session::get('status') == 'error')
            <div class="col-md-8">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i>{{Session::get('message')}}
                </div>
            </div>
            @endif
            <!-- left column -->
            <div class="col-md-8" style="margin-bottom:30px">
                @if($method=='PUT')
                    <h4 id="offer-title-header">Edit Offer : {{$offer['Title']}}</h4>
                @else
                    <h4>Create New Offer</h4>
                @endif
            </div>
            <div class="col-md-8">
                <div class="row-fluid">
                    <form method="post" action="{{URL::to('offer')}}/@if(isset($offer)){{$offer->ID}}@endif" id="offerForm" class="form-horizontal" role="form">
                        <input type="hidden" name="_method" value="{{$method}}">
                        <input type="hidden" name="OfferActive" id="OfferActive" value="{{$offer['OfferActive'] or ''}}">
                        <input type="hidden" name="ProviderID" id="ProviderID" value="@if(isset($offer)) {{$offer->ProviderID}} @elseif(isset($provider)) {{$provider->ID}} @endif">
                        <input type="hidden" name="FullPrice" id="FullPrice">
                        <input type="hidden" name="Latitude" id="Latitude">
                        <input type="hidden" name="Longitude" id="Longitude">
                        <div class="form-group">
                            <label for="OfferTypeID" class="top5 control-label col-md-3">Offer Type</label>
                            <div class="col-md-9">
                                <input name="OfferTypeID" id="OfferTypeID" class="validate[required]" style="width:100%" value="{{$offer['OfferTypeID'] or ''}}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Title" class="top5 control-label col-md-3">Offer Title</label>
                            <div class="col-md-9">
                                <input name="Title" id="Title" placeholder="Offer Title" class="form-control input-sm validate[required]" value="{{$offer['Title'] or ''}}" />
                                <span class="help-block" id="TitleWordCount">0 words</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Description" class="top5 control-label col-md-3">Offer Description</label>
                            <div class="col-md-9">
                                <textarea name="Description" id="Description" placeholder="Offer Description" class="form-control input-sm validate[required]" rows="4" >{{$offer['Description'] or ''}}</textarea>
                                <span class="help-block" id="DescriptionWordCount">0 words</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FinePrint" class="top5 control-label col-md-3">Fine Print</label>
                            <div class="col-md-9">
                                <textarea name="FinePrint" id="FinePrint" placeholder="Fine Print" class="form-control input-sm validate[required]" rows="4" >{{$offer['FinePrint'] or ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PriceBeforeDiscount" class="top5 control-label col-md-3">Price Before Discount</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input name="PriceBeforeDiscount" placeholder="Price Before Discount" id="PriceBeforeDiscount" data-format="$ 0,0" class="form-control input-sm validate[required]" value="{{$offer['PriceBeforeDiscount'] or ''}}" />
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Discount" class="top5 control-label col-md-3">Discount</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span id="discountAmount" class="input-group-addon hide">$</span>
                                    <input name="Discount" id="Discount" placeholder="Discount" class="form-control input-sm" value="{{$offer['Discount'] or ''}}" />
                                    <span id="discountPercent" class="input-group-addon hide">%</span>
                                </div>
                            </div>
                            <label for="DiscountBy" class="col-md-1">&nbsp;</label>
                            <div class="col-md-4">
                                <select name="DiscountBy" id="DiscountBy" class="form-control input-sm">
                                    <option value="$" @if(isset($offer) && $offer['DiscountBy'] == '$') selected="true" @endif>Discount By $ Amount</option>
                                    <option value="%" @if(isset($offer) && $offer['DiscountBy'] == '%') selected="true" @endif>Discount By % Amount</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group input-daterange">
                            <label for="StartDate" class="top5 control-label col-md-3">Date Range</label>
                            <div class="col-md-4">
                                <input name="StartDate" id="StartDate" placeholder="Start Date" class="form-control input-sm validate[required] date" value="{{isset($offer['StartDate']) ? date('m/d/Y', strtotime($offer['StartDate'])) : ''}}" />
                            </div>
                            <label for="EndDate" class="col-md-1">&nbsp;</label>
                            <div class="col-md-4">
                                <input name="EndDate" id="EndDate" placeholder="End Date" class="form-control input-sm validate[required] date" value="{{isset($offer['EndDate']) ? date('m/d/Y', strtotime($offer['EndDate'])) : ''}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="RedeemByDate" class="top5 control-label col-md-3">Redeem By</label>
                            <div class="col-md-3">
                                <input name="RedeemByDate" id="RedeemByDate" placeholder="Redeem By" class="form-control input-sm validate[required] date" value="{{isset($offer['EndDate']) ? date('m/d/Y', strtotime($offer['EndDate'])) : ''}}" />
                            </div>

                            <label for="QuantityLimit" class="top5 control-label col-md-3">Quantity Limit</label>
                            <div class="col-md-3">
                                <input name="QuantityLimit" id="QuantityLimit" placeholder="No Limit" class="form-control input-sm" value="{{$offer['QuantityLimit'] or ''}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="AdvertisingLevelID" class="top5 control-label col-md-3">Advertising Level</label>
                            <div class="col-md-9">
                                <input name="AdvertisingLevelID" id="AdvertisingLevelID" placeholder="Select Advertising Level" class="validate[required]" style="width:100%" value="{{$offer['AdvertisingLevelID'] or ''}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="OfferImagePicker" class="top5 control-label col-md-3">Select Image</label>
                            <div class="col-md-9">
                                <input name="OfferImagePicker" id="OfferImagePicker" style="width:100%" />
                                <input name="OfferImage" id="OfferImage" type="hidden" value="{{$offer['OfferImage'] or ''}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-6">
                                <button class="btn btn-default" id="btn-offer-save" data-offer-active="0">Save Offer</button>
                                <button class="btn btn-primary right" id="btn-offer-broadcast" data-offer-active="1">Broadcast Offer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- preview section -->
            <div class="col-md-4 offer-preview">
                <div class="row offer-preview-row">
                    <div class="col-xs-5" style="border:solid 1px #ddd; padding:2px; background: #44f; color: white">
                        @if(isset($offer) && $offer['OfferImage'] !='')
                            <img id="offer-preview-image" src="{{asset($offer['OfferImage'])}}" style="width: 100%;" class="img-thumbnail" alt="140x140">
                        @else
                            <img id="offer-preview-image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIwAAACMCAYAAACuwEE+AAADsklEQVR4nO3YX08aaRiG8X7/j/IwLSywOgLbYt1qMW4FammTrQsUUCsz8xXuHkB1qzbpfaD86XXwSwwZ85r3ucZ5h2dFUQj4Vc9W/QdgsxAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDywYFk+lLd1979bIiQhGhP45Gyu5dl+vqU1vl5TWVw+HNNfn1SP2/U1WSUESiSnqg7uir8o1Yfz1sUDDX+rddU3W3obTy84Hllx/06nncDPVmYPmFzv5KFp9Xm3rZrC1+Tlp6P8s3YP31sEHBfDfX5/0XDw8sm+mslSgq+zp++eKHgWWTE9UjFLGr7ixXkV+ony6GWjseaXrWUhKhqHc0mhfKJu+URihKqU4n2SOvP37gP9V62qJgMk17DSVR1dH5pc4Pyj8M7Opjc3FHV95omC2uHx5WFp/tfdBVdqnBq+eKCNU7A52kJUUkavSmd4b5SOvnq97X3yyYbHKqtBSqd4aaF/M7A8t10U+Xj4OOxsuBjY+Xj4WdrmZ5ofzqk9rl28dJ0nqvWfZ0669+b3+bYDJN3/2piET1vaaazYZ2vg++sqvWm48aD37lDs807iyHGGUdfL5+4vXX35YFEw+r/6Mv49szRO8nZ4hs2tVe8v/fO9Zo/nTrr35vtyqYTJP+ofbbbTWWbylRbandfq23g9m9c8bdM0SRXywOpBEq1Vpqt+oqRSiSpvqzTEU20eny3NLsnetseZ6pvf1P10+x/sr3d+uCub2z77r/evvAwIrF9yC9g1SVUiiipMrua3WHX5UXmcYnO4tzS6OnaVYovxwsX4+rOjq/fuT1V723WxkM1gHBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwEAwsBAMLwcBCMLAQDCwEAwvBwEIwsBAMLAQDC8HAQjCwfAPq1BsmxkosAgAAAABJRU5ErkJggg==" style="width: 100%" class="img-thumbnail" alt="140x140">
                        @endif
                    </div>
                    <div class="col-xs-7">
                        <strong class="offer-preview-title" id="offer-title-preview" style="display:block">Offer Title</strong>

                        <table class="offer-preview-price">
                            <tr>
                                <td rowspan="2"><strong id="offer-preview-price" style="font-size:20px"></strong>&nbsp;</td>
                                <td><strong  id="offer-preview-purchased"># Purchased</strong></td>
                            </tr>
                            <tr>
                                <td><strong id="offer-preview-priceoff"></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row offer-preview-row">
                    <div class="col-md-12">
                        <h5>Details</h5>
                        <p id="offer-preview-description"></p>
                    </div>
                </div>

                <div class="row offer-preview-row">
                    <div class="col-md-12">
                        Must be redeemed by : <span id="offer-preview-redeem"></span>
                    </div>
                </div>

                <div class="row offer-preview-row">
                    <div class="col-md-12">
                        <h5>Location</h5>

                        <div class="row">
                            <div class="col-md-5">
                                {{isset($provider) ? $provider->Name : ''}}<br>
                                {{isset($provider) ? $provider->Street : ''}}<br>
                                {{isset($provider) ? $provider->City : ''}}, {{isset($provider) ? $provider->State : ''}}, {{isset($provider) ? $provider->Zip : ''}}<br>
                                {{isset($provider) ? $provider->Phone : ''}}<br>
                                @if(isset($provider) ? $provider->Website : '')
                                <a href="{{isset($provider) ? $provider->Website : ''}}">{{isset($provider) ? $provider->Website : ''}}</a>
                                @endif
                            </div>
                            <div class="col-md-7" style="height:100px; border:solid 1px #ddd" id="providerMapContainer"></div>
                        </div>

                    </div>
                </div>
                <div class="row offer-preview-row">
                    <div class="col-md-12">
                        <h5>Fine Print</h5>
                        <p id="offer-preview-fineprint"></p>
                        <p id="offer-preview-redeemstep" style="margin-top:20px; font-size:10px"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table style="width:100%">
                            <tr>
                                <td style="width:60%">
                                    <span id="offer-preview-remaining"></span>
                                    <br>
                                    <span id="offer-preview-limit"></span>
                                </td>
                                <td style="width=40%">
                                    <button class="btn btn-success btn-lg" type="button">Buy Now!</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">&nbsp;</div>
            </div>
        </div>
    </div>
    @include('offer.image-selector')
@stop
