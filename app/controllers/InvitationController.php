<?php

class InvitationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$leadData = Input::get('Invite');
        $leadObject = new ProviderLead;

        foreach ($leadData as $key => $value) {
            $leadObject->{$key} = $value;
        }

        $leadObject->PCID = $this->data['providerCredential']->ID;
        $leadObject->ProviderID = $this->data['provider']->ID;

        $saved = $leadObject->save();

        return Response::json(array(
            'success'   => $saved
        ));
	}

}