<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Appointment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'date_apt' => $this->date_apt,
            'schedule_id' => $this->date_apt,
            'apt_amount' => $this->apt_amount,
            'speciality_id' => $this->speciality_id,
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'doctor_user_id' => $this->doctor_user_id,
            'patient_user_id' => $this->patient_user_id,
            'note' => $this->note,
            'confirm_date' => $this->confirm_date,
            'identifier' => $this->identifier,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
