<?php

namespace App\Repository\Eloquent;

use App\Model\Contact;
use App\Model\RegionContact;
use App\Repository\IContactRepository;
use Illuminate\Support\Facades\Auth;

class ContactRepository implements IContactRepository
{
    public function all()
    {
        $allContacts = Contact::orderBy('created_at', 'desc')->get();
        return $allContacts;
    }

    public function findById($id)
    {
        $contact = Contact::find($id);
        return $contact;
    }
    public function findRegionalContact($id)
    {
        $regionContact = RegionContact::find($id);
        return $regionContact;
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact->regional_id != Auth::id()) {
            return false;
        }
        $deleteContact = $contact->delete();
        if ($deleteContact) {
            return true;
        } else {
            return false;
        }
    }
    public function getRegionContacts($regionalUser)
    {
        $regionContact = RegionContact::where('regional_id', $regionalUser->id)->get();
        return $regionContact;
    }
    public function saveData($request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        if ($contact) {
            return true;
        } else {
            return false;
        }
    }
    public function saveRegionalContact($regionalUser, $request)
    {
        $contact = RegionContact::create([
            'regional_id' => $regionalUser->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        if ($contact) {
            return true;
        } else {
            return false;
        }
    }
}
