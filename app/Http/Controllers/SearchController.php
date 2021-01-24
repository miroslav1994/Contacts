<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Phone;
use Egulias\EmailValidator\Exception\ConsecutiveAt;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Search for contact
     *
     */
    public function search(Request $request)
    {
        $query = $request->get('search','');
        $contacts = Contact::where('first_name','ILIKE','%'.$query.'%')
            ->orWhere('last_name','ILIKE','%'.$query.'%')
            ->get();
        $phones = Phone::where('type', 'ILIKE', '%'.$query.'%')
            ->orWhere('phone', 'LIKE', '%'.$query.'%')
            ->get();

        $searchResults = $contacts->merge($phones);

        $data = array();
        foreach ($searchResults as $results) {
            if(!empty($results->contact_id)) array_push($data, $results->contact_id);
            else array_push($data, $results->id);
        }
        $contacts = Contact::whereIn('id', $data)->get();
        $data = [
            'contacts' => $contacts,
            'search' => $query
        ];

        return view('frontend.index')->with($data);
    }
}
