<?php

class Appointment extends BaseModel {
	protected $guarded = array();
    protected $table = 'petpaws.Appointments';
    protected $primaryKey = 'ID';

	public static $rules = array();

    public function customer(){
        return $this->hasOne('Customer', 'ID', 'CustomerID');
    }

    /**
     * count appointment by status
     */
    public static function counter($date, $providerID){

        $appointmentsCounter = array(
            'confirmed' => self::getByDate($date, $providerID)->where('AppointmentStatus', '=', 'confirmed')->count(),
            'canceled'  => self::getByDate($date, $providerID)->where('AppointmentStatus', '=', 'canceled')->count(),
            'noreply'   => self::getByDate($date, $providerID)->where('AppointmentStatus', '=', 'noreply')->count()
        );

        return $appointmentsCounter;
    }

    /**
     * filter appointments by date and provider id
     */
    public static function getByDate($date, $providerID = null){

        $appointments = self::whereRaw(
            (
                (Config::get('database.default') == 'mysql')
                //mysql specific
                ? "DATE(DateStart) = '$date'"

                //mssql specific
                : "CAST(DateStart AS DATE) = '$date'"
            )
        );

        if($providerID){
            $appointments->where('ProviderID', '=', $providerID);
        }

        return $appointments;
    }
}
