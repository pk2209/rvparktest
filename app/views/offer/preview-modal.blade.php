<div class="modal fade" id="offer-preview-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Offer Preview</h3>
            </div>
            <div class="modal-body">
                <div class="row" id="offerLoader">
                    <div class="col-md-12 text-center">
                        Loading...<br>
                        <img src="{{asset($asset_base_dir)}}/img/loading.gif" alt="">
                    </div>
                </div>
                @include('offer.preview')
            </div>
            <div class="modal-footer">&nbsp;</div>
        </div>
    </div>
</div>