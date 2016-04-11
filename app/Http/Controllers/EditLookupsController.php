<?php

namespace App\Http\Controllers;

use App\Suburb;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;

class EditLookupsController extends Controller
{
    // List of suburbs
    public function suburbs()
    {
        // Get suburbs
        $suburbs = Suburb::all();

        return view('lookups.suburbs', compact('suburbs'));
    }

    // Ajax handler for saving suburbs record
    public function ajax_save_suburbs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Suburb
        if (empty($index)) {
            // Create new Suburb, if this locality is already used, throw the error
            try {
                Suburb::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Suburb
            $suburb = Suburb::where('postcode', $index)->first();

            // Update Suburb, if this locality is already used, throw the error
            try {
                $suburb->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting suburbs record
    public function ajax_delete_suburbs()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Suburb
        $suburb = Suburb::where('postcode', $index)->first();

        // Delete Suburb
        try {
            //$suburb->destroy($suburb->id);
            $suburb->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }
}
