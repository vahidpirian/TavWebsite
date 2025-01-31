<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contact.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contact.show', compact('contact'));
    }
} 