    <div class="modal fade" id="share-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title center" id="modal-title">Thank you for sharing PetPaws with your friends!</h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" id="invite-form">
                        <div class="form-group">
                            <label for="invite_email" class="col-lg-3 control-label">Friends Email</label>
                            <div class="col-lg-9">
                                <input type="text" class="input-sm form-control validate[required]" name="Invite[Email]" id="invite_email" placeholder="Share Friends Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invite_company" class="col-lg-3 control-label">Company Name</label>
                            <div class="col-lg-9">
                                <input type="text" class="input-sm form-control validate[required]" name="Invite[CompanyName]" id="invite_company" placeholder="Share Friends Company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invite_name" class="col-lg-3 control-label">Name</label>
                            <div class="col-lg-9">
                                <input type="text" class="input-sm form-control validate[required]" name="Invite[Name]" id="invite_name" placeholder="Share Friends Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invite_phone" class="col-lg-3 control-label">Phone</label>
                            <div class="col-lg-9">
                                <input type="text" class="input-sm form-control validate[required]" name="Invite[Phone]" id="invite_phone" placeholder="Share Friends Phone#">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat white btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-flat primary btn-sm" id="btn-invite" data-method="">Invite your bud!</button>
                </div>
            </div>
        </div>
    </div>