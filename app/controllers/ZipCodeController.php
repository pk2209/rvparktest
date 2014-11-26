<?php

class ZipCodeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($state = null)
	{
		$keyword = Input::get('keyword');
        $limit = Input::get('limit');
        $skip = Input::get('page', 0) - 1;
        $state = Input::get('state', '');

        $zipQuery  = ZipCode::select(array(
                           'ZipCode as id', 'Locality', 'Region', 'ZipCode as text'
                    ))
                    ->where('ZipCode', 'like', "$keyword%")
                    ->where('Type', '=', 'STANDARD')
                    ->where('Region', 'like', "%$state%")
                    ->limit($limit)
                    ->skip($skip*$limit)
                    ->orderBy('ZipCode')
                    ->get()
                    ->toArray();

        $zipTotal = ZipCode::select('ID')
                    ->where('ZipCode', 'like', "$keyword%")
                    ->where('Type', '=', 'STANDARD')
                    ->where('Region', 'like', "%$state%")
                    ->count();

        return Response::json(array(
            'total'     => $zipTotal,
            'zipcode'   => $zipQuery
        ));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

}