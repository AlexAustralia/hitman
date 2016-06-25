<?php

namespace App\Http\Controllers;

use App\Client;
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
}
