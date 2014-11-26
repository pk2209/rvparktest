<?php

class BaseController extends Controller {

	/**
	 * container for data, assets, js variables etc
	 * @var array
	 */
	protected $data 	= array();

	public function __construct(){
		/** default title */
		$this->data['title'] = '';

		/** queued css files */
		$this->data['css'] = array(
            'internal'  => array(),
            'external'  => array()
        );

        /** queued js files */
        $this->data['js'] = array(
            'internal'  => array(),
            'external'  => array()
        );

        /** prepared message info */
        $this->data['message'] = array(
        	'error'	=> array(),
        	'info'	=> array(),
        	'debug'	=> array(),
        );

        /** global javascript var */
        $this->data['global'] = array();

        /** base dir for asset file */
        $this->data['asset_base_dir'] = 'assets/admin/';
        $this->data['providerCredential'] = Sentry::getUser();

        if($this->data['providerCredential']){
            $this->data['provider'] = $this->data['providerCredential']->providers()->first();
            Config::set('app.timezone', $this->data['provider']->Timezone);
        }


        $this->loadBaseCss();
        $this->loadBaseJs();
        $this->enableValidation();
        $this->registerGlobal('baseDir',asset(''));
        $this->registerGlobal('inviteApiCall', URL::to('invite'));
        $this->registerGlobal('activeMenu','');
        $this->registerGlobal('activeSubMenu','');

	}


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * enqueue css asset to be loaded
	 * @param  [string] $css     [css file to be loaded relative to base_asset_dir]
	 * @param  [array]  $options [location=internal|external, position=first|last|after:file|before:file]
	 */
	protected function loadCss($css, $options=array()){
        $location = (isset($options['location'])) ? $options['location']:'internal';
        $position = (isset($options['position'])) ? $options['position']:'last';    //after:file, before:file, first, last

        if(!in_array($css,$this->data['css'][$location])){
            if($position=='first' || $position=='last'){
                $key = $position;
                $file='';
            }else{
                list($key,$file) =  explode(':',$position);
            }

            switch($key){
                case 'first':
                    array_unshift($this->data['css'][$location],$css);
                break;

                case 'last':
                    $this->data['css'][$location][]=$css;
                break;

                case 'before':
                case 'after':
                    $varkey = array_keys($this->data['css'][$location],$file);
                    if($varkey){
                        $nextkey = ($key=='after') ? $varkey[0]+1 : $varkey[0];
                        array_splice($this->data['css'][$location],$nextkey,0,$css);
                    }else{
                        $this->data['css'][$location][]=$css;
                    }
                break;
            }
        }
    }


	/**
	 * enqueue js asset to be loaded
	 * @param  [string] $js      [js file to be loaded relative to base_asset_dir]
	 * @param  [array]  $options [location=internal|external, position=first|last|after:file|before:file]
	 */
    protected function loadJs($js, $options=array()){
        $location = (isset($options['location'])) ? $options['location']:'internal';
        $position = (isset($options['position'])) ? $options['position']:'last';    //after:file, before:file, first, last

        if(!in_array($js,$this->data['js'][$location])){
            if($position=='first' || $position=='last'){
                $key = $position;
                $file='';
            }else{
                list($key,$file) =  explode(':',$position);
            }

            switch($key){
                case 'first':
                    array_unshift($this->data['js'][$location],$js);
                break;

                case 'last':
                    $this->data['js'][$location][]=$js;
                break;

                case 'before':
                case 'after':
                    $varkey = array_keys($this->data['js'][$location],$file);
                    if($varkey){
                        $nextkey = ($key=='after') ? $varkey[0]+1 : $varkey[0];
                        array_splice($this->data['js'][$location],$nextkey,0,$js);
                    }else{
                        $this->data['js'][$location][]=$js;
                    }
                break;
            }
        }
    }

    /**
     * clear enqueued css asset
     */
    protected function resetCss(){
        $this->data['css']         = array(
            'internal'  => array(),
            'external'  => array()
        );
    }

    /**
     * clear enqueued js asset
     */
    protected function resetJs(){
        $this->data['js']         = array(
            'internal'  => array(),
            'external'  => array()
        );
    }

    /**
     * remove individual css file from queue list
     * @param  [string] $css [css file to be removed]
     */
    protected function removeCss($css){
        $key=array_keys($this->data['css']['internal'],$css);
        if($key){
            array_splice($this->data['css']['internal'],$key[0],1);
        }

        $key=array_keys($this->data['css']['external'],$css);
        if($key){
            array_splice($this->data['css']['external'],$key[0],1);
        }
    }

    /**
     * remove individual js file from queue list
     * @param  [string] $js [js file to be removed]
     */
    protected function remmoveJs($js){
        $key=array_keys($this->data['js']['internal'],$js);
        if($key){
            array_splice($this->data['js']['internal'],$key[0],1);
        }

        $key=array_keys($this->data['js']['external'],$js);
        if($key){
            array_splice($this->data['js']['external'],$key[0],1);
        }
    }

    public function addMessage($message, $type='info'){
    	$this->data['message'][$type] = $message;
    }

    public function registerGlobal($key,$val){
    	$this->data['global'][$key] =  $val;
    }

    protected function loadBaseCss(){

        $this->loadCss('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800', array('location' => 'external'));
        $this->loadCss('bootstrap/bootstrap.min.css');
        $this->loadCss('bootstrap/bootstrap-overrides.css');
        $this->loadCss('lib/jquery-ui-1.10.3.custom.min.css');
        $this->loadCss('compiled/layout.css');
        $this->loadCss('compiled/elements.css');
        $this->loadCss('compiled/icons.css');
        $this->loadCss('lib/font-awesome.css');
        $this->loadCss('compiled/index.css');
        $this->loadCss('style.css');
    }

    protected function loadBaseJs(){
        $this->loadJs('jquery-1.10.1.min.js');
        $this->loadJs('jquery-ui-1.10.3.custom.min.js');
        $this->loadJs('bootstrap.min.js');
        $this->loadJs('theme.js');
        $this->loadJs('app/jquery.notification.js');
        $this->loadJs('app/common.js');
    }

    /**
     * load jquery validation engine
     */
    protected function enableValidation(){
        $this->loadJs('jquery.validationEngine.js');
        $this->loadJs('languages/jquery.validationEngine-en.js');
        $this->loadCss('lib/jquery.validationEngine.css');
    }

    /**
     * load jquery data tables
     */
    protected function enableDataTable(){
        $this->loadJs('lodash.min.js');
        $this->loadJs('jquery.dataTables.min.js');
        $this->loadJs('jquery.dataTables.bootstrap.js');
        $this->loadJs('datatables.responsive.js');
        $this->loadCss('lib/dataTables.bootstrap.css');
        $this->loadCss('datatables.responsive.css');
        //$this->loadCss('compiled/datatables.css');
    }

}