<?php

namespace App\Http\Controllers\individual;

use App\Http\Controllers\Controller;
use App\Repository\IContactRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $contacts;

    public function __construct(IContactRepository $contacts)
    {
        $this->contacts = $contacts;
    }
    public function index()
    {
        // $regionContacts = $this->contacts->all();
        $regionalUser=Auth::user();
        $regionContacts = $this->contacts->getRegionContacts($regionalUser);
        return view('individual.contact.index', compact('regionContacts'));
    }

    public function destroy($id)
    {
        try {
            $deleteContactUs = $this->contact->destroy($id);
            if ($deleteContactUs) {
                Toastr::success('Contact Deleted', 'Operation Success');
                return redirect()->back();
            }
            Toastr::error('Failed to Delete Contact', 'Operation Failed');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), 'Operation Failed');
            return redirect()->back();
        }
    }
}
