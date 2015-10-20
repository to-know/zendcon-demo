<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ValidationController extends Controller
{
    /**
     * Show a form so we can demo validation.
     *
     * @return Response
     */
    public function showForm()
    {
        return view('validation.form');
    }

    /**
     * Process the form input.
     *
     * @param  Request  $request
     * @return Response
     */
    public function processForm(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'votes' => 'required|integer',
            'passphrase' => 'required|confirmed|min:6',
        ]);

        // Store Something In Database

        return 'This data was valid!';
    }

    /**
     * Process the form in a different way.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function processFormAnotherWay(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'votes' => 'required|integer',
            'passphrase' => 'required|confirmed|min:6',
        ]);

        if ($v->fails()) {
            return back()->withErrors($v);
        }

        return 'This data was valid!';
    }

    /**
     * Process this form with a form request.
     *
     * @param  Requests\StoreUserVotes  $request
     * @return Response
     */
    public function processFormWithFormRequest(Requests\StoreUserVotes $request)
    {
        return 'This data was valid!';
    }
}
