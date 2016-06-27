<?php

namespace App\Http\Controllers;

use App\Client;
use App\Property;
use App\Title;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    /**
     * Display client's property index page
     *
     * @param $id
     * @return view
     */

    public function index($id)
    {
        // Get client's details
        $client = Client::find($id);

        // Get clients's property
        $property = $client->getProperty;

        return view('property.index', compact('client', 'property'));
    }

    /**
     * Create new client's property
     *
     * @return view
     */

    public function create($id)
    {
        // Get client's details
        $client = Client::find($id);

        // Get all titles, streets
        $titles = Title::all();

        return view('property.edit', compact('client', 'titles'));
    }

    /**
     * Edit client's property
     *
     * @param $id_c, $id_p
     * @return view
     */

    public function edit($id)
    {
        // Get all titles
        $titles = Title::all();
        $property = Property::find($id);
        $client = $property->getClient;

        return view('property.edit', compact('titles', 'client', 'property'));
    }

    /**
     * Save created or edited client's property
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function save($id, Request $request)
    {
        $this->validate($request, [
            'address' => 'required'
        ]);

        // Get all input data
        $input = $request->all();

        $property = isset($input['id']) ? Property::find($input['id']) : new Property();

        // Save Property data
        $property->client_id = $id;
        $property->address = $input['address'];
        $property->suburb = $input['locality'];
        $property->postcode = $input['postal_code'];
        $property->property_notes = $input['property_notes'];
        $property->occupant_is_client = isset($input['occupant_is_client']) ? true : false;

        if (isset($input['occupant_title_id']) && $input['occupant_title_id'] > 0) {
            $property->occupant_title_id = $input['occupant_title_id'];
        } else {
            $property->occupant_title_id = null;
        }

        $property->occupant_name = isset($input['occupant_name']) ? $input['occupant_name'] : null;
        $property->occupant_surname = isset($input['occupant_surname']) ? $input['occupant_surname'] : null;
        $property->occupant_phone = isset($input['occupant_phone']) ? $input['occupant_phone'] : null;

        $property->save();

        return redirect('clients/property/' . $id)->with('success', 'Property has been saved/updated successfully');
    }
}
