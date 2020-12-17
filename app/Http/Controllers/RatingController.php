<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Patient;
use App\User;
use App\Review;
use App\Answer;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('patients.ratings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'doctor_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
            'body' => 'nullable',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);

        $rating = $request->rating;

        $body = $request->body;

        $author = User::findOrFail($request->user_id);

        $doctor->createRating($rating, $author, $body);

        $review = new Review();

        $review->title = $request->title;

        $review->body = $request->body;

        $review->rating = $request->rating;

        $patient = Patient::where('user_id', $request->user_id)->first();

        $review->patient_id = $patient->id;

        $review->user_id = $request->user_id;

        $review->doctor_id = $request->doctor_id;

        $doctor = Doctor::findOrFail($request->doctor_id);

        $review->doctor_user_id = $doctor->user_id;

        //$review->recommend = $request->recommend;

        //$review->approuved = $request->approuved;

        $review->save();

        return back()->with('success', 'Rating added successfully.');
    }


    public function saveAnswer(Request $request)
    {
        $answer = new Answer();

        $answer->body = $request->body;

        $answer->review_id = $request->review_id;

        $answer->doctor_id = $request->doctor_id;

        $doctor = Doctor::findOrFail($request->doctor_id);

        $answer->doctor_user_id = $doctor->user_id;

        $answer->user()->associate($request->user());

        $patient = Patient::findOrFail($request->patient_id);

        $answer->patient_id = $patient->id;

        $review = Review::find($request->review_id);

        $review->answers()->save($answer);

        return back()->with('success', 'Comment added successfully.');
    }

    public function replyStore(Request $request)
    {
        $reply = new Answer();

        $reply->body = $request->get('body');

        $reply->review_id = $request->review_id;

        $reply->doctor_id = $request->doctor_id;

        $doctor = Doctor::findOrFail($request->doctor_id);

        $reply->doctor_user_id = $doctor->user_id;

        $reply->user()->associate($request->user());

        $patient = Patient::findOrFail($request->patient_id);

        $reply->patient_id = $patient->id;

        $reply->parent_id = $request->get('answer_id');

        $review = Review::find($request->review_id);

        $review->answers()->save($reply);

        return back()->with('success', 'Reply saved successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
