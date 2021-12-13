<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repository\IContactRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contacts;

    public function __construct(IContactRepository $contacts)
    {
        $this->contacts = $contacts;
    }
    public function index()
    {
        $allContacts = $this->contacts->all();
        return view('admin.contact.index', compact('allContacts'));
    }
    public function addSubmit()
    {
    }

    public function destroy($id)
    {
        try {
            $deleteContactUs = $this->contact->destroy($id);
            if ($deleteContactUs) {
                Toastr::success('Contact Deleted', 'Operation Success');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), 'Operation Error');
            return redirect()->back();
        }
    }
}
