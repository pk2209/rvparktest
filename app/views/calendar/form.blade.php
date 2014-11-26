                <form action="{{URL::to('calendar')}}" method="POST" class="form-horizontal" id="appointment-form">
                    <div class="row">
                        <div class="col-md-5 col-md-push-7">
                            <div id="inline-calendar"></div>
                            <input type="hidden" name="Date" id="Date">
                            <input type="hidden" name="removedPet" id="removedPet">
                        </div>

                        <div class="col-md-7 col-md-pull-5">
                            <h4 class="info">Appointment Information</h4>
                            <div class="form-group">
                                <label for="Title" class="top5 control-label col-md-3">Appt Title</label>
                                <div class="col-md-9">
                                    <input name="Title" id="Title" placeholder="Appointment Title" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="TimeStart" class="top5 control-label col-md-3">Time</label>
                                <div class="col-md-4 input-group bootstrap-timepicker">
                                    <input name="TimeStart" id="TimeStart" placeholder="Start" class="timepicker form-control input-sm validate[required]" value="" />
                                    <a href="javascript:void(0);" class="input-group-addon"><i class="icon-time"></i></a>
                                </div>
                                <label for="TimeEnd" class="top5 control-label col-md-1">To</label>
                                <div class="col-md-4 input-group bootstrap-timepicker">
                                    <input name="TimeEnd" id="TimeEnd" placeholder="End" class="timepicker form-control input-sm validate[required]" value="" />
                                    <a href="javascript:void(0);" class="input-group-addon"><i class="icon-time"></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Notes" class="top5 control-label col-md-3">Notes</label>
                                <div class="col-md-9">
                                    <textarea name="Notes" id="Notes" rows="5" placeholder="Appointment Notes" class="form-control input-sm validate[required]" value="" ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="NotificationTime" class="top5 control-label col-md-3">Notify Customer</label>
                                <div class="col-md-2">
                                    <input name="NotificationTime" id="NotificationTime" placeholder="Time" class="form-control input-sm validate[required]" value="" />
                                </div>
                                <div class="col-md-4">
                                    <select name="NotificationUnit" id="NotificationUnit" placeholder="Appointment Title" class="validate[required]" style="width:100%">
                                        <option value="minute">Minutes</option>
                                        <option value="hour">Hours</option>
                                        <option value="day">Days</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="info">Customer Information</h4>
                            <div class="form-group">
                                <label for="FirstName" class="top5 control-label col-md-3">Customer Name</label>
                                <div class="col-md-5">
                                    <input name="Customer[FirstName]" id="FirstName" placeholder="First name" class="form-control input-sm validate[required]" value="" />
                                </div>
                                <div class="col-md-4">
                                    <input name="Customer[LastName]" id="LastName" placeholder="Last name" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Address" class="top5 control-label col-md-3">Address</label>
                                <div class="col-md-9">
                                    <input name="Customer[Address]" id="Address" placeholder="Address" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="City" class="top5 control-label col-md-3">&nbsp;</label>
                                <div class="col-md-3">
                                    <input name="Customer[City]" id="City" placeholder="City" class="form-control input-sm validate[required]" value="" />
                                </div>
                                <div class="col-md-3">
                                    <input name="Customer[State]" id="State" placeholder="State" style="width:100%" class="validate[required]" value="" />
                                </div>
                                <div class="col-md-3">
                                    <input name="Customer[ZipCode]" id="ZipCode" placeholder="Zip Code" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="MobilePhone" class="top5 control-label col-md-3">Mobile Phone</label>
                                <div class="col-md-9">
                                    <input name="Customer[MobilePhone]" id="MobilePhone" placeholder="Mobil ePhone" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Email" class="top5 control-label col-md-3">Email Address</label>
                                <div class="col-md-9">
                                    <input name="Customer[Email]" id="Email" placeholder="Email Address" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="info">Pet Information</h4>
                            <div class="form-group">
                                <label for="PetName" class="top5 control-label col-md-3">Pet Name</label>
                                <div class="col-md-9">
                                    <input name="Pet[PetName]" id="PetName" placeholder="Pet Name" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Species" class="top5 control-label col-md-3">Dog / Cat</label>
                                <div class="col-md-9">
                                    <input type="hidden" name="Pet[Species]" id="Species">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default btn-species">Dog</button>
                                        <button type="button" class="btn btn-sm btn-default btn-species">Cat</button>
                                        <button type="button" class="btn btn-sm btn-default btn-species">Other</button>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Breed" class="top5 control-label col-md-3">Breed</label>
                                <div class="col-md-9">
                                    <input name="Pet[Breed]" id="Breed" placeholder="Breed" style="width:100%" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="VetName" class="top5 control-label col-md-3">Vet Name</label>
                                <div class="col-md-9">
                                    <input name="Pet[VetName]" id="VetName" placeholder="Vet Name" class="form-control input-sm validate[required]" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Vaccine" class="top5 control-label col-md-3">Vaccine</label>
                                <div class="col-md-9">
                                    <select name="Pet[Vaccine]" id="Vaccine" placeholder="Select Current / Not Current" class="validate[required]" style="width:100%">
                                        <option value=""></option>
                                        <option value="current">Current</option>
                                        <option value="not_current">Not Current</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-info pull-right" id="btn-appointment-save">Save Appointment</button>
                            <button data-dismiss="modal" class="btn btn-md btn-default pull-right" id="btn-appointment-cancel" style="margin-right: 10px">Cancel</button>
                        </div>
                    </div>
                </form>
