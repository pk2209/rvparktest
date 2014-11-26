<?php

use Carbon\Carbon;

class CalendarController extends BaseController {

    private $field;

    public function __construct(){
        parent::__construct();

        $this->field = array(
            'CustomerID',
            'DateStart',
            'DateEnd',
            'AppointmentType',
            'Reminder',
            'Title',
            'AppointmentStatus',
            'Notes',
            'PetName',
            'PetSpecies',
            'PetBreed',
            'VetName',
            'Vaccine'
        );

        $this->registerGlobal('activeMenu', 'calendar');
        $this->registerGlobal('appointmentApiCall', URL::to('calendar'));
        $this->registerGlobal('catBreeds', StaticData::catBreeds(true));
        $this->registerGlobal('dogBreeds', StaticData::dogBreeds(true));
        $this->registerGlobal('states', StaticData::states(true));


        $this->loadCss('lib/select2.css');
        $this->loadCss('lib/datepicker.css');
        $this->loadCss('lib/bootstrap-timepicker.min.css');

        //$this->loadCss('lib/fullcalendar.print.css');
        $this->loadJs('select2.min.js');
        $this->loadJs('bootstrap-datepicker.js');
        $this->loadJs('bootstrap-timepicker.js');
        $this->loadJs('app/create_appointment.js');

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $providerCredential = $this->data['providerCredential'];
        $provider = $this->data['provider'];


        if(Request::ajax()){
            $start  = date('Y-m-d 23:59:59', (int) Input::get('start'));
            $end    = date('Y-m-d 23:59:59', (int) Input::get('end'));


            $color  = array(
                'confirmed' => '#2F60FF',
                'canceled'  => '#dddddd',
                'noreply'   => '#9ECAE9'
            );
            $textColor  = array(
                'confirmed' => '#ffffff',
                'canceled'  => '#333333',
                'noreply'   => '#003B76'
            );

            $apptCollection = Appointment::with(array(
                        'customer' => function($customer){
                            $customer->select(array('ID', 'FirstName', 'LastName'));
                        }
                    ))
                    ->select(array(
                        'ID as id',
                        'Title as title',
                        'DateStart as start',
                        'DateEnd as end',
                        'AppointmentStatus',
                        'Notes',
                        'PetName',
                        'PetBreed',
                        'CustomerID'
                    ))
                    ->where('DateStart','>',$start)
                    ->where('DateEnd','<=',$end)
                    ->where('ProviderID', '=', $provider->ID)
                    ->get()
                    ->toArray();

            foreach ($apptCollection as $key => $appointment) {
                $apptCollection[$key]['color'] = $color[$appointment['AppointmentStatus']];
                $apptCollection[$key]['textColor'] = $textColor[$appointment['AppointmentStatus']];
                $apptCollection[$key]['allDay'] = date('Y-m-d', strtotime($appointment['start'])) != date('Y-m-d', strtotime($appointment['end']));

                $apptCollection[$key]['start'] = Carbon::createFromTimestamp(strtotime($appointment['start']), $provider->Timezone)->__toString();
                $apptCollection[$key]['end'] = Carbon::createFromTimestamp(strtotime($appointment['end']), $provider->Timezone)->__toString();
            }

            return Response::json($apptCollection);
        }else{
            $today = date('Y-m-d');
            $this->data['appointment'] = Appointment::counter($today, $this->data['provider']->ID);

            $this->removeCss('style.css');
            $this->loadCss('compiled/calendar.css');
            $this->loadCss('lib/fullcalendar.css');
            $this->loadCss('style.css');

            $this->loadJs('fullcalendar.min.js');
            $this->loadJs('app/calendar.js');

            return View::make('calendar.index', $this->data);
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('calendar.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $providerCredential = $this->data['providerCredential'];
        $provider = $this->data['provider'];

        $fields = $this->field;

        $apptData = Input::all();

        $dateStart  = Carbon::createFromTimeStamp(($apptData['DateStart'] / 1000), 'GMT');
        $dateEnd    = Carbon::createFromTimeStamp(($apptData['DateEnd'] / 1000), 'GMT');
        $apptData['DateStart']  = $dateStart->__toString();
        $apptData['DateEnd']    = $dateEnd->__toString();
        $apptData['AppointmentStatus'] = 'noreply';

        $apptObject = new Appointment;
        $apptObject->ProviderID = $provider->ID;

        foreach ($fields as $field) {
            $apptObject->{$field} = isset($apptData[$field]) ? $apptData[$field] : '';
        }

        $created = $apptObject->save();

        return Response::json(array(
            'success'   => $created
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
        return View::make('calendar.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('calendar.create', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$provider = $this->data['provider'];
        $apptData = Input::all();
        $apptObject = Appointment::where('ProviderID', '=', $provider->ID)->find($id);

        foreach ($this->field as $field) {
            if(isset($apptData[$field])){
                if($field == 'DateEnd' || $field == 'DateStart'){
                    $apptObject->{$field} = Carbon::createFromTimeStamp(($apptData[$field] / 1000), 'GMT')->__toString();
                }else{
                    $apptObject->{$field} = $apptData[$field];
                }
            }
        }

        $updated = $apptObject->save();

        return Response::json(array(
            'success'   => $updated,
            'data'      => $apptObject->toArray()
        ));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$provider = $this->data['provider'];

        $deleted = Appointment::where('ProviderID', '=', $provider->ID)
                              ->where('ID', '=', $id)
                              ->delete();

        return Response::json(array(
            'success'   => $deleted
        ));
	}

}
