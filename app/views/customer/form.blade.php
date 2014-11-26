<div class="row">
    <form action="{{$action}}" method="POST" class="form-horizontal" id="customer-form">
        <div class="col-md-12">
            <input type="hidden" name="PetRemoved" id="PetRemoved">
            <input type="hidden" name="Customer[ID]" value="@if(isset($customer)){{$customer['ID']}}@endif">

            @if(isset($customer))
            <input type="hidden" name="_method" value="PUT">
            @endif


            <div class="form-group">
                <label for="FirstName" class="top5 control-label col-md-3">Customer Name</label>
                <div class="col-md-4">
                    <input name="Customer[FirstName]" id="FirstName" placeholder="First name" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['FirstName']}}@endif" />
                </div>
                <div class="col-md-5">
                    <input name="Customer[LastName]" id="LastName" placeholder="Last name" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['LastName']}}@endif" />
                </div>
            </div>

            <!-- customer pet -->
            @if(isset($customer))
                @foreach ($customer['pets'] as $index => $pet)
                    <div class="form-group pet-info-name">
                        <label for="PetName" class="top5 control-label col-md-3">Pet Name</label>
                        <div class="col-md-4">
                            <input type="hidden" data-name="Pet[:num][ID]" name="Pet[{{$index}}][ID]" value="{{$pet['ID']}}">
                            <input type="text" data-name="Pet[:num][PetName]" name="Pet[{{$index}}][PetName]" id="PetName" rows="5" placeholder="Pet Name" class="form-control input-sm validate[required]" value="{{$pet['PetName']}}" />
                        </div>

                        <label for="" class="top5 control-label col-md-1 col-xs-12">Species</label>

                        <div class="col-md-3 col-xs-8 btn-species-container">
                            <input type="hidden" data-name="Pet[:num][PetSpecies]" name="Pet[{{$index}}][PetSpecies]" value="{{$pet['PetSpecies']}}">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-default btn-species @if($pet['PetSpecies'] == 'Dog') btn-species-active @endif">Dog</button>
                                <button type="button" class="btn btn-sm btn-default btn-species @if($pet['PetSpecies'] == 'Cat') btn-species-active @endif">Cat</button>
                                <button type="button" class="btn btn-sm btn-default btn-species @if($pet['PetSpecies'] == 'Other') btn-species-active @endif">Other</button>
                            </div>
                        </div>

                        <div class="col-md-1 col-xs-4">
                            @if(count($customer['pets'])-1 == $index)
                                <button class="btn btn-sm btn-default pull-right btn-add-pet" data-id="{{$pet['ID']}}"><i class="icon-plus"></i></button>
                            @else
                                <button class="btn btn-sm btn-default pull-right btn-remove-pet" data-id="{{$pet['ID']}}"><i class="icon-remove"></i></button>
                            @endif
                        </div>
                    </div>

                    <div class="form-group pet-info-breed">
                        <label for="Breed" class="top5 control-label col-md-3">Breed</label>
                        <div class="col-md-9">
                            <input type="text" data-name="Pet[:num][Breed]" name="Pet[{{$index}}][Breed]" rows="5" placeholder="Breed" style="width:100%" class="form-control input-sm validate[required] input-text" value="{{$pet['Breed']}}" />
                        </div>
                    </div>
                @endforeach
            @else

                <div class="form-group pet-info-name">
                    <label for="PetName" class="top5 control-label col-md-3">Pet Name</label>
                    <div class="col-md-4">
                        <input type="hidden" data-name="Pet[:num][ID]" name="Pet[1][ID]">
                        <input type="text" data-name="Pet[:num][PetName]" name="Pet[1][PetName]" rows="5" placeholder="Pet Name" class="form-control input-sm validate[required]" value="" />
                    </div>

                    <label for="" class="top5 control-label col-md-1 col-xs-12">Species</label>

                    <div class="col-md-3 col-xs-8 btn-species-container">
                        <input type="hidden" data-name="Pet[:num][PetSpecies]" name="Pet[1][PetSpecies]">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default btn-species">Dog</button>
                            <button type="button" class="btn btn-sm btn-default btn-species">Cat</button>
                            <button type="button" class="btn btn-sm btn-default btn-species">Other</button>
                        </div>
                    </div>

                    <div class="col-md-1 col-xs-4">
                        <button class="btn btn-sm btn-default pull-right btn-add-pet"><i class="icon-plus"></i></button>
                    </div>
                </div>

                <div class="form-group pet-info-breed">
                    <label for="Breed" class="top5 control-label col-md-3">Breed</label>
                    <div class="col-md-9">
                        <input type="text" data-name="Pet[:num][Breed]" name="Pet[1][Breed]" rows="5" placeholder="Breed" style="width:100%" class="form-control input-sm validate[required] input-text" value="" />
                    </div>
                </div>
            @endif
            <!-- /end of customer pet -->

            <div class="form-group">
                <label for="Email" class="top5 control-label col-md-3">Email</label>
                <div class="col-md-9">
                    <input type="text" name="Customer[Email]" id="Email" rows="5" placeholder="Email" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['Email']}}@endif" />
                </div>
            </div>

            <div class="form-group">
                <label for="Phone" class="top5 control-label col-md-3">Phone</label>
                <div class="col-md-9">
                    <input type="text" name="Customer[Phone]" id="Phone" rows="5" placeholder="Phone" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['Phone']}}@endif" />
                </div>
            </div>

            <div class="form-group">
                <label for="MobilePhone" class="top5 control-label col-md-3">Mobile Phone</label>
                <div class="col-md-9">
                    <input type="text" name="Customer[MobilePhone]" id="MobilePhone" rows="5" placeholder="Mobile Phone" class="form-control input-sm" value="@if(isset($customer)){{$customer['MobilePhone']}}@endif" />
                </div>
            </div>

            <div class="form-group">
                <label for="Address" class="top5 control-label col-md-3">Address</label>
                <div class="col-md-9">
                    <input type="text" name="Customer[Address]" id="Address" rows="5" placeholder="Adrress" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['Address']}}@endif" />
                </div>
            </div>

            <div class="form-group">
                <label for="City" class="top5 control-label col-md-3">&nbsp;</label>
                <div class="col-md-3">
                    <input name="Customer[City]" id="City" placeholder="City" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['City']}}@endif" />
                </div>
                <div class="col-md-3">
                    <input name="Customer[State]" id="State" placeholder="State" style="width:100%" class="validate[required]" value="@if(isset($customer)){{$customer['State']}}@endif" />
                </div>
                <div class="col-md-3">
                    <input name="Customer[ZipCode]" id="ZipCode" placeholder="Zip Code" class="form-control input-sm validate[required]" value="@if(isset($customer)){{$customer['ZipCode']}}@endif" />
                </div>
            </div>

            <div class="form-group">
                <label for="Notes" class="top5 control-label col-md-3">Notes</label>
                <div class="col-md-9">
                    <textarea name="Customer[Notes]" id="Notes" rows="5" placeholder="Notes" class="form-control input-sm" >@if(isset($customer)){{$customer['Notes']}}@endif</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-sm pull-right btn-info" id="btn-customer-save">Save</button>
                    <a href="{{URL::to('customer')}}" class="btn btn-sm pull-right btn-default" id="btn-customer-cancel" data-dismiss="modal" style="margin-right: 10px">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>