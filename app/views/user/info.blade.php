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
                <h4>Business Info</h4>
            </div>
            <div class="col-md-8 column">
                <form method="post" action="{{$action}}" id="provider-detail" class="form-horizontal" >
                    <input type="hidden" value="{{$method or 'POST'}}" name="_method">
                    <div class="form-group">
                        <label for="CompanyName" class="top5 col-md-3 control-label">Companys:</label>
                        <div class="col-md-9">
                            <input name="ProviderCredential[CompanyName]" id="CompanyName" placeholder="Company Name" class="form-control input-sm validate[required]" type="text" value="@if($provider){{$credential['CompanyName']}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Website" class="top5 col-md-3 control-label">Website:</label>
                        <div class="col-md-9">
                            <input name="Provider[Website]" id="Website" placeholder="Website URL" class="form-control input-sm validate[required,custom[url]]" type="text" value="@if($provider && $provider['Website'] != ''){{$provider['Website']}}@else{{'http://'}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ProviderServices" class="top5 col-md-3 control-label">Service Offered:</label>
                        <div class="col-md-9">
                           <select name="ProviderServices[]" id="ProviderServices" multiple="true" placeholder="Service Offered" style="width:100%" class="select2 validate[required]">
                                @foreach($services as $service)
                                    <option value="{{$service->ID}}" @if(in_array($service->ID, $providerServices))selected="true"@endif >{{$service->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="top5 col-md-3 control-label">Address:</label>
                        <div class="col-md-9">
                            <input name="Provider[Street]" id="Address" placeholder="Address" class="form-control input-sm validate[required]" type="text" value="@if($provider){{$provider['Street']}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="top5 col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-3">
                            <input name="Provider[City]" id="City" placeholder="City" class="form-control input-sm validate[required]" type="text" placeholder="City" value="@if($provider){{$provider['City']}}@endif" />
                        </div>
                        <div class="col-md-3">
                            <select name="Provider[State]" id="State" placeholder="State" style="width:100%" class="select2 validate[required]">
                                @foreach($states as $stateID => $stateName)
                                    <option value="{{$stateID}}" @if($provider['State'] == $stateID)selected="true"@endif>{{$stateName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input name="Provider[Zip]" id="Zip" placeholder="Zip Code" class="form-control input-sm validate[required,custom[onlyLetterNumber]]" type="text" placeholder="Postal Code" value="@if($provider){{$provider['Zip']}}@endif" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Timezone" class="top5 col-md-3 control-label">Timezone:</label>
                        <div class="col-md-9">
                           <select name="Provider[Timezone]" id="Timezone" placeholder="Timezone" style="width:100%" class="select2 validate[required]">
                                @foreach(DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US') as $timezone)
                                    <option value="{{$timezone}}" @if($provider && $provider['Timezone'] == $timezone) selected="selected" @endif >{{$timezone}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ZipCodeServiced" class="top5 col-md-3 control-label">Zip Code Serviced:</label>
                        <div class="col-md-9">
                            <input type="hidden" name="Provider[ZipCodeServiced]" id="ZipCodeServiced" style="width:100%" type="text" placeholder="Zip Code Serviced" value="@if($provider){{$provider['ZipCodeServiced'] or ''}}@endif" />
                            <input type="hidden" name="ZipCodeRemoved" id="ZipCodeRemoved">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Phone" class="top5 col-md-3 control-label">Phone:</label>
                        <div class="col-md-9">
                            <input name="Provider[Phone]" id="Phone" placeholder="Phone Number" class="form-control input-sm validate[custom[phone]]" type="text" value="@if($provider){{$provider['Phone']}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName" class="top5 col-md-3 control-label">First Name:</label>
                        <div class="col-md-9">
                            <input name="ProviderCredential[FirstName]" id="FirstName" placeholder="First Name" class="form-control input-sm validate[required,custom[onlyLetterSp]]" type="text" value="@if($credential){{$credential['FirstName']}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="top5 col-md-3 control-label">Last Name:</label>
                        <div class="col-md-9">
                            <input name="ProviderCredential[LastName]" id="LastName" placeholder="Last Name" class="form-control input-sm validate[required,custom[onlyLetterSp]]" type="text" value="@if($credential){{$credential['LastName']}}@endif"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="top5 col-md-3 control-label">Email:</label>
                        <div class="col-md-9">
                            <input name="ProviderCredential[Email]" id="Email" placeholder="Email Address" class="form-control input-sm validate[required,custom[email]]" type="text" value="@if($credential){{$credential['Email']}}@endif"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="top5 col-md-3 control-label">Password:</label>
                        <div class="col-md-9">
                            <input name="ProviderCredential[password]" id="password" placeholder="Password" class="form-control input-sm validate[required]" type="password" value="@if($credential){{Crypt::decrypt($credential['Hash'])}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="top5 col-md-3 control-label">Confirm Password:</label>
                        <div class="col-md-9">
                            <input name="ProviderCredential[confirm_password]" id="confirm_password" placeholder="Confirm Password" class="form-control input-sm validate[required,equals[password]]" type="password" value="@if($credential){{Crypt::decrypt($credential['Hash'])}}@endif" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="SubID" class="top5 col-md-3 control-label">Choose Subscription:</label>
                        <div class="col-md-9">
                            <select name="Provider[SubID]" id="SubID" placeholder="Subscription Level" style="width:100%" class="select2 validate[required]">
                                @foreach($subscriptions as $subscription)
                                    <option value="{{$subscription->ID}}" @if($provider && $subscription->ID == $provider->SubID)selected="true"@endif>{{$subscription->Description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(isset($providerCredential) && !$providerCredential->hasAccess('admin'))
                    <div class="form-group">
                        <label for="agreement" class="top5 col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-9">
                            <label class="radio">
                                <input type="checkbox" name="agreement" id="agreement" value="agree" class="validate[required]">
                                I Agree to Pet Paws <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                    </div>
                    @else
                    <div class="form-group">
                        <label for="permission.admin" class="top5 col-md-3 col-xs-12 control-label">Permission:</label>
                        <div class="col-md-3 col-xs-4 radio">
                            <label class="top5 control-label">
                                <input type="checkbox" class="permission_checkbox" @if( ($credential) && $credential->hasAccess('admin')) checked="true" @endif id="permissions.admin" value="1">
                                <input type="hidden" name="ProviderCredential[permissions][admin]" @if( ($credential) && $credential->hasAccess('admin')) value="1" @else value="0" @endif >
                                Admin
                            </label>
                        </div>
                        <div class="col-md-3 col-xs-4 radio">
                            <label class="top5 control-label">
                                <input type="checkbox" class="permission_checkbox" @if( ($credential) && $credential->hasAccess('dashboard')) checked="true" @endif id="permissions.dashboard" value="1">
                                <input type="hidden" name="ProviderCredential[permissions][dashboard]" @if( ($credential) && $credential->hasAccess('dashboard')) value="1" @else value="0" @endif >
                                Dashboard
                            </label>
                        </div>
                        <div class="col-md-3 col-xs-4 radio">
                            <label class="top5 control-label">
                                <input type="checkbox" class="permission_checkbox" @if( ($credential) && $credential->hasAccess('superuser')) checked="true" @endif id="permissions.superuser" value="1">
                                <input type="hidden" name="ProviderCredential[permissions][superuser]" @if( ($credential) && $credential->hasAccess('superuser')) value="1" @else value="0" @endif >
                                Super User
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-8">
                            <button class="btn-glow primary" id="btn-save">Save Changes</button> or
                            <a href="#confirm-modal" data-toggle="modal">Cancel</a>
                        </div>
                    </div>

                    <input type="hidden" id="Country" name="Provider[Country]">
                    <input type="hidden" id="Ratings" name="Provider[Ratings]">
                    <input type="hidden" id="Latitude" name="Provider[Latitude]">
                    <input type="hidden" id="Longitude" name="Provider[Longitude]">
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="loading-message">Are you sure want to cancel?</h3>
            </div>
            <div class="modal-body">
                <p>
                    You will not able to access any feature in this site before completing your information.
                </p>
                <p>
                    Click "No" to continue with the form, or "Yes" to complete the form later and logout.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">No</button>
                <a type="button" class="btn btn-sm btn-danger" href="{{URL::to('user/logout')}}">Yes</a>
            </div>
        </div>
    </div>
</div>
@stop