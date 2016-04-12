<?php

namespace App\Http\Controllers;

use App\LicenceDescription;
use App\Suburb;
use App\TechnicianType;
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
            $suburb->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of technician types
    public function technician_types()
    {
        // Get technician types
        $technician_types = TechnicianType::all();

        return view('lookups.technician-types', compact('technician_types'));
    }

    // Ajax handler for saving technician types record
    public function ajax_save_technician_types()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Technician Type
        if (empty($index)) {
            // Create new Technician Type, if this type is already used, throw the error
            try {
                TechnicianType::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Technician Type
            $technician_type = TechnicianType::where('name', $index)->first();

            // Update Technician Type, if this type is already used, throw the error
            try {
                $technician_type->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Technician Type record
    public function ajax_delete_technician_types()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Technician Type
        $technician_type = TechnicianType::where('name', $index)->first();

        // Delete Technician Type
        try {
            $technician_type->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }

    // List of Licence Descriptions
    public function licence_description()
    {
        // Get Licence Descriptions
        $licence_descriptions = LicenceDescription::all();

        return view('lookups.licence-descriptions', compact('licence_descriptions'));
    }

    // Ajax handler for saving licence description record
    public function ajax_save_licence_description()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Save Licence Description
        if (empty($index)) {
            // Create new Licence Description, if this type is already used, throw the error
            try {
                LicenceDescription::create($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }
        else {
            // Find edited Technician Type
            $licence_description = LicenceDescription::where('name', $index)->first();

            // Update Licence Description, if this type is already used, throw the error
            try {
                $licence_description->update($input);
            } catch (QueryException $e) {
                return json_encode('Error');
            }
        }

        return json_encode('OK');
    }

    // Ajax handler for deleting Licence Description record
    public function ajax_delete_licence_description()
    {
        // Get parameters
        $input = Input::all();

        $index = $input['index'];

        // Find deleting Licence Description
        $licence_description = LicenceDescription::where('name', $index)->first();

        // Delete Licence Description
        try {
            $licence_description->delete();
        } catch (QueryException $e) {
            return json_encode('Error');
        }

        return json_encode('OK');
    }
}
