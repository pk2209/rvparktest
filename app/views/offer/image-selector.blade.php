    <!-- iframe uploader -->
    <iframe src="{{URL::to('upload/offer-image')}}" frameborder="0" class="hide" id="imageUploader"></iframe>
    <!-- image modal section -->
    <div class="modal fade" id="image-category-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div style="padding:0;background-color: #FAFAFA; background-image: linear-gradient(to bottom, #FFFFFF, #F2F2F2);" class="modal-header">
                    <button data-dismiss="modal" style="margin:5px 10px 5px; float:right" class="btn btn-flat primary btn-sm" id="imagePickerDone"><strong>Done</strong></button>
                    <button data-dismiss="modal" style="margin:5px 10px 5px; float:right" class="btn btn-flat white btn-sm"><strong>Cancel</strong></button>
                    <div style="clear:both; margin-top:5px"></div>
                </div>
                <div class="modal-body" id="imageList" style="padding:0; max-height:400px; overflow-y:auto">
                    <!-- image selector here -->
                    <div class="panel-group" id="serviceList">
                    @foreach($services as $service)
                        <div class="panel panel-default" style="border-radius:0; margin-top:0">
                            <div class="panel-heading" style="background:white;padding:5px;border-left:solid 3px #66aaff; border-radius:0">
                                <h4 class="panel-title" style="font-weight:bold">
                                    <a id="panel-opener-{{$service->ID}}" data-toggle="collapse" style="display:block" data-parent="#serviceList" href="#service{{$service->id}}">
                                        {{$service->Name}}
                                    </a>
                                </h4>
                            </div>
                            <div id="service{{$service->id}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @if($predefinedImages[$service->ID])
                                        @for($i=0; $i < ceil(count($predefinedImages[$service->ID])/3); $i++)
                                            <div class="row" style="margin-top:10px">
                                            @for($j=($i*3); $j <= ($i*3)+2; $j++)
                                                @if(isset($predefinedImages[$service->ID][$j]))
                                                    <div class="col-md-4">
                                                        <label class="image-label">
                                                            <input type="checkbox" class="image-picker" value="{{$predefinedImages[$service->ID][$j]}}">
                                                            <img src="{{asset($predefinedImages[$service->ID][$j])}}" alt="140x140" class="img-thumbnail" style="width: 100%;">
                                                        </label>
                                                    </div>
                                                @endif
                                            @endfor
                                            </div>
                                        @endfor
                                    @else
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-md-12 center"><strong>No Image found in this category</strong></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="panel panel-default" style="border-radius:0; margin-top:0">
                            <div class="panel-heading" style="background:white;padding:5px;border-left:solid 3px #66aaff; border-radius:0">
                                <h4 class="panel-title" style="font-weight:bold">
                                    <a data-toggle="collapse" style="display:block" data-parent="#serviceList" href="#imageUpload">
                                        Upload
                                    </a>
                                </h4>
                            </div>
                            <div id="imageUpload" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="image-offer-field" readonly="true">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" id="image-offer-browse"><i class="icon-search"></i> Browse</button>
                                                    <button class="btn btn-primary" type="button" id="image-offer-upload"><i class="icon-cloud-upload"></i> Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body" id="uploaded-container">
                                    @if($uploadedImages)
                                        @for($i=0; $i < ceil(count($uploadedImages)/3); $i++)
                                            <div class="row" style="margin-top:10px">
                                            @for($j=($i*3); $j <= ($i*3)+2; $j++)
                                                @if(isset($uploadedImages[$j]))
                                                    <div class="col-md-4">
                                                        <label class="image-label">
                                                            <input type="checkbox" class="image-picker" value="{{$uploadedImages[$j]}}">
                                                            <img src="{{asset($uploadedImages[$j])}}" alt="140x140" class="img-thumbnail" style="width: 100%;">
                                                        </label>
                                                    </div>
                                                @endif
                                            @endfor
                                            </div>
                                        @endfor
                                    @else
                                        <div class="row" id="no-uploaded-found" style="margin-top:10px">
                                            <div class="col-md-12 center"><strong>No Image found in this category</strong></div>
                                        </div>
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>