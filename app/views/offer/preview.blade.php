<div class="row" id="offerPreview">
    <div class="col-md-8 col-md-offset-2 offer-preview">
        <div class="row offer-preview-row">
            <div class="col-md-5" style="border:solid 1px #ddd; background: #44f; color: white; padding:2px">
                <img src="" style="width:100%; margin:0" alt="offer-image" id="offer-preview-image">
            </div>
            <div class="col-md-7">
                <strong class="offer-preview-title preview-placeholder" id="previewTitle" style="display:block">Offer Title</strong>

                <table class="offer-preview-price">
                    <tr>
                        <td rowspan="2">
                            <del><span style="font-size:14px">$</span><span class="preview-placeholder" id="previewPriceBeforeDiscount" style="font-size:14px"></span></del><br>
                            <strong style="font-size:20px">$</strong><strong class="preview-placeholder" id="previewFullPrice" style="font-size:20px"></strong>
                        </td>
                        <td><strong class="preview-placeholder" id="previewClaimedCount"></strong> <strong># Purchased</strong></td>
                    </tr>
                    <tr>
                        <td><strong class="preview-placeholder" id="previewDiscount"></strong><strong> off</strong></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row offer-preview-row">
            <div class="col-md-12">
                <h5>Details</h5>
                <p class="preview-placeholder" id="previewDescription"></p>
            </div>
        </div>

        <div class="row offer-preview-row">
            <div class="col-md-12">
                Must be redeemed by : <span class="preview-placeholder" id="previewRedeemByDate"></span>
            </div>
        </div>

        <div class="row offer-preview-row">
            <div class="col-md-12">
                <h5>Location</h5>

                <div class="row">
                    <div class="col-md-5" id="providerDetail">
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
                <p class="preview-placeholder" id="previewFinePrint"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table style="width:100%">
                    <tr>
                        <td style="width:60%">
                            <span class="preview-placeholder" id="previewRemaining"></span>
                            <br>
                            <span class="preview-placeholder" id="previewQuantityLimit"></span>
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
