<div class="modal fade" id="customer-preview-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Customer Details</h3>
            </div>
            <div class="modal-body">
                <div class="row" id="customerPreviewLoader" style="display:none">
                    <div class="col-md-12 text-center">
                        Loading...<br>
                        <img src="{{asset($asset_base_dir)}}/img/loading.gif" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">Customer Name : </label>
                            </div>
                            <div class="col-md-9" id="customer-preview-Name">=</div>
                        </div>

                        <div class="row customer-preview-row" id="preview-pets"></div>

                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">Email : </label>
                            </div>
                            <div class="col-md-9" id="customer-preview-Email"></div>
                        </div>

                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">Phone : </label>
                            </div>
                            <div class="col-md-9" id="customer-preview-Phone"></div>
                        </div>

                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">Mobile Phone : </label>
                            </div>
                            <div class="col-md-9" id="customer-preview-MobilePhone"></div>
                        </div>

                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">Address : </label>
                            </div>
                            <div class="col-md-9" id="customer-preview-Address"></div>
                        </div>

                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">&nbsp; : </label>
                            </div>
                            <div class="col-md-3" id="customer-preview-City"></div>
                            <div class="col-md-3" id="customer-preview-State"></div>
                            <div class="col-md-3" id="customer-preview-ZipCode"></div>
                        </div>

                        <div class="row customer-preview-row">
                            <div class="text-bold col-md-3">
                                <label for="">Notes : </label>
                            </div>
                            <div class="col-md-9" id="customer-preview-Notes"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>