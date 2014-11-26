<div class="modal fade" id="appointment-create-modal">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Appointment Details</h3>
            </div>
            <div class="modal-body">
                <div class="row" id="appointmentLoader">
                    <div class="col-md-12 text-center">
                        Loading...<br>
                        <img src="{{asset($asset_base_dir)}}/img/loading.gif" alt="">
                    </div>
                </div>
                @include('calendar.form')
        </div>
    </div>
</div>