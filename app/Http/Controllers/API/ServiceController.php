<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Service as ServiceResource;
use App\Service;
use App\Speciality;
use Validator;

class ServiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        foreach ($services as $service) {
            $speciality = $service->speciality;
            $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
            $service['speciality'] = $speciality;
        }
    
        return $this->sendResponse($services, 'Services retrieved successfully.');
    }

    public function getServices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'speciality_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $services = Service::where('speciality_id', $request->input('speciality_id'))
                            ->get();
                            
        if($services){
            
            foreach ($services as $service) 
            {
                $speciality = $service->speciality;
                $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
                $service['speciality'] = $speciality;
            }
        
            return $this->sendResponse($services, 'Services retrieved successfully.');
        }
        
        return $this->sendResponse([], 'No Service fond for this speciality.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
  
        if (is_null($service)) {

            return $this->sendError('Service not found.');
        }

        $speciality = $service->speciality;
        $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
        $service['speciality'] = $speciality;
   
        return $this->sendResponse($service, 'Service retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
   
        return $this->sendResponse([], 'Service deleted successfully.');
    }
}
