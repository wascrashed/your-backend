<?php

namespace App\Http\Controllers\Api\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poster = Poster::all();
        return ['poster' => $poster];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'start' => 'required',
            'finish' => 'required',
            'cost' => 'required',
            'image' => 'required',
            'title' => 'required',
            'address' => 'required',
            'link' => 'required',
            'description' => 'required',
            'free' => 'required'
        ];
        $this->validate($request, $rules);

        $data = $request->all();

        $poster = Poster::create($data);
        return ['heading' => $poster];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poster = Poster::findOrFail($id);
        return ['heading' => $poster];
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
        $poster = Poster::findOrFail($id);
        $this-> validate($request, [
            'start' => 'timestamp',
            'finish' => 'timestamp',
            'cost' => 'integer',
            'image' => 'string',
            'title' => 'string',
            'address' => 'string',
            'link' => 'string',
            'description' => 'string',
            'free' => 'string'
        ]);
        $poster->update($request->all());
        return ['heading' => $poster];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poster = Poster::findOrFail($id);
        $poster->delete();
        return ['poster' => $poster];
    }
}
