<html>
    <head>
        
    </head>
    <body>
        <form id="imageForm" action="{{URL::to('upload/offer-image')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" id="predefined" name="predefined" value="0">
            <input type="hidden" id="id" name="id" value="0">
            <input type="file" id="imageField" name="image">
        </form>
        @if(isset($isResponse))
        <script>
            var $ = window.parent.$;
            @if(isset($imagePath))
                alert('Image uploaded!');

                var $uploadContainer = $('#uploaded-container');

                if($('#no-uploaded-found').length > 0){
                    $uploadContainer.html(
                        '<div class="row" style="margin-top:10px">'+
                            '<div class="col-md-4">'+
                                '<label class="image-label">'+
                                    '<input type="checkbox" class="image-picker" value="{{$imagePath}}">'+
                                    '<img src="{{asset($imagePath)}}" alt="140x140" class="img-thumbnail" style="width: 100%;">'+
                                '</label>'+
                            '</div>'+
                        '</div>'
                    );
                }else{
                    $lastRow = $uploadContainer.find('.row').last();
                    if($lastRow.find('.col-md-4').length < 3){
                        $lastRow.append(
                            '<div class="col-md-4">'+
                                '<label class="image-label">'+
                                    '<input type="checkbox" class="image-picker" value="{{$imagePath}}">'+
                                    '<img src="{{asset($imagePath)}}" alt="140x140" class="img-thumbnail" style="width: 100%;">'+
                                '</label>'+
                            '</div>'
                        );
                    }else{
                        $uploadContainer.append(
                            '<div class="row" style="margin-top:10px">'+
                                '<div class="col-md-4">'+
                                    '<label class="image-label">'+
                                        '<input type="checkbox" class="image-picker" value="{{$imagePath}}">'+
                                        '<img src="{{asset($imagePath)}}" alt="140x140" class="img-thumbnail" style="width: 100%;">'+
                                    '</label>'+
                                '</div>'+
                            '</div>'
                        );
                    }
                }
            @endif

            @if(isset($error))
                alert('{{$error}}');
            @endif

            $('#image-offer-upload').prop('disabled', false);
            $('#image-offer-upload').html('<i class="icon-cloud-upload"></i> Upload');
        </script>
        @endif
    </body>
</html>