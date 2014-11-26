<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- stylesheet -->
    @foreach($css['external'] as $css_file)
    <link rel="stylesheet" type="text/css" href="{{ $css_file }}" />
    @endforeach
    @foreach($css['internal'] as $css_file)
    <link rel="stylesheet" type="text/css" href="{{ asset($asset_base_dir) }}/css/{{ $css_file }}" />
    @endforeach
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->

    <!-- javascript global variable -->
    <script type="text/javascript">
    var global = {
    @foreach($global as $key => $val)
        {{$key}} : @if(is_array($val)) {{json_encode($val)}} @elseif(is_object($val) || is_numeric($val)) {{$val}} @else '{{$val}}' @endif ,
    @endforeach
    };

    var responsiveHelper;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 640
    };
    </script>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    @include('template.navbar')
    @include('template.sidebar')
    <div class="content">
        @yield('content')
    </div>
    @include('template.loading-modal')
    @include('template.share-modal')
    <!-- scripts -->
    @foreach($js['external'] as $js_file)
    <script type="text/javascript" src="{{ $js_file }}"></script>
    @endforeach
    @foreach($js['internal'] as $js_file)
    <script type="text/javascript" src="{{ asset($asset_base_dir) }}/js/{{ $js_file }}"></script>
    @endforeach
</body>
</html>