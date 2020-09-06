<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petition;
use Auth;

class PetitionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allpetition()
    {
        $petitions = Petition::orderBy('id', 'DESC')->paginate(10);
        return view('petition.all')->with('petitions', $petitions);
    }

    public function index()
    {
        $petitions = Petition::orderBy('id', 'DESC')->paginate(1);
        return view('petition.index')->with('petitions', $petitions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'petition_title' => 'required|string',
            'signature_target' => 'required|numeric',
            'petition_description' => 'required|string|min:10',
            'featured_video_url' => 'nullable',
            'video_headline' => 'nullable|string|min:3',
            'video_details' => 'nullable|string|min:10',
            'cover_image' => 'nullable|image|max:1999',
            'letter' => 'required|string|min:10',
            'letter_recipient' => 'required|string',
            'update_title' => 'nullable|string|min:4',
            'recipient_designation' => 'required|email',
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get filename with the extension
            $filenamewithext = $request
                ->file('cover_image')
                ->getClientOriginalName();

            //Get file name only
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

            //Get file extension only
            $extension = $request
                ->file('cover_image')
                ->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //upload image
            $path = $request
                ->file('cover_image')
                ->storeAs('public/cover_images', $filenametostore);
        } else {
            $filenametostore = '';
        }

        $petition = new Petition();
        $petition->petition_title = $request->input('petition_title');
        $petition->signature_target = $request->input('signature_target');
        $petition->petition_description = $request->input(
            'petition_description'
        );
        // $petition->petition_preview_video = $request->input(
        //   'petition_preview_video'
        //);
        $petition->featured_video_url = $request->input('featured_video_url');
        $petition->video_headline = $request->input('video_headline');
        $petition->video_details = $request->input('video_details');
        $petition->cover_image = $filenametostore;
        $petition->letter = $request->input('letter');
        $petition->letter_recipient = $request->input('letter_recipient');
        $petition->update_title = $request->input('update_title');
        $petition->recipient_designation = $request->input(
            'recipient_designation'
        );

        $petition->user_id = $user_id;

        $petition->save();

        return redirect('/petitions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $petition = Petition::find($id);
        return view('petition.show')->with('petition', $petition);
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
        $petition = Petition::find($id);

        $this->authorize('modify', $petition);

        return view('petition.edit')->with('petition', $petition);
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
        $user_id = Auth::user()->id;
        $request->validate([
            'petition_title' => 'required|string',
            'signature_target' => 'required|numeric',
            'petition_description' => 'required|string|min:10',
            'featured_video_url' => 'nullable',
            'video_headline' => 'nullable|string|min:3',
            'video_details' => 'nullable|string|min:10',
            'cover_image' => 'nullable|image|max:1999',
            'letter' => 'required|string|min:10',
            'letter_recipient' => 'required|string',
            'update_title' => 'nullable|string|min:4',
            'recipient_designation' => 'required|email',
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get filename with the extension
            $filenamewithext = $request
                ->file('cover_image')
                ->getClientOriginalName();

            //Get file name only
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

            //Get file extension only
            $extension = $request
                ->file('cover_image')
                ->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //upload image
            $path = $request
                ->file('cover_image')
                ->storeAs('public/cover_images', $filenametostore);
        } else {
            $filenametostore = '';
        }

        $petition = Petition::find($id);
        $petition->petition_title = $request->input('petition_title');
        $petition->signature_target = $request->input('signature_target');
        $petition->petition_description = $request->input(
            'petition_description'
        );
        // $petition->petition_preview_video = $request->input(
        //   'petition_preview_video'
        //);
        $petition->featured_video_url = $request->input('featured_video_url');
        $petition->video_headline = $request->input('video_headline');
        $petition->video_details = $request->input('video_details');
        $petition->cover_image = $filenametostore;
        $petition->letter = $request->input('letter');
        $petition->letter_recipient = $request->input('letter_recipient');
        $petition->update_title = $request->input('update_title');
        $petition->recipient_designation = $request->input(
            'recipient_designation'
        );

        $petition->user_id = $user_id;

        $petition->save();

        return redirect('/petitions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petition = Petition::find($id);
        $petition->delete();

        return back()->with(
            'message',
            'You have successfully deleted the petition'
        );
    }
}
