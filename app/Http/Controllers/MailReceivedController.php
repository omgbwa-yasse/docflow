<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mail;
use App\Models\MailType;
use App\Models\MailPriority;
use App\Models\MailTypology;
use App\Models\MailAttachment;

class MailReceivedController extends Controller
{


    public function index()
    {
        $mails = Mail::with('mailPriority', 'mailTypology', 'mailAttachment')->get();
        return view('mails.received.index', compact('mails'));
    }




    public function create()
    {
        $mailPriorities = MailPriority::all();
        $mailTypologies = MailTypology::all();
        $mailTypeId = MailType::where('name', 'received')->value('id');
        $organisations = organisation :: all();
        $authors = User::where('id', '!=', Auth::id())->get();
        if (!$mailTypeId) {
            abort(404, 'Type de mail "send" introuvable.');
        }

        return view('mails.received.create', compact('mailPriorities', 'mailTypologies', 'mailTypeId','organisations','authors'));
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:mails,code',
            'object' => 'required|string|max:255',
            'description' => 'nullable|string',
            'authors' => 'nullable|string',
            'document_id' => 'nullable|exists:documents,id',
            'mail_priority_id' => 'required|exists:mail_priorities,id',
            'mail_typology_id' => 'required|exists:mail_typologies,id',
            'type_id' => 'required|exists:mail_types,id',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $mail = Mail::create($validatedData);

        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $path = $document->store('mail_attachments');

            $mailAttachment = MailAttachment::create([
                'path' => $path,
                'filename' => $document->getClientOriginalName(),
                'size' => $document->getSize(),
            ]);

            $mail->mailAttachment()->associate($mailAttachment);
        }


        if ($request->has('mail_container_ids')) {
            $mail->mailContainers()->attach($request->input('mail_container_ids'));
        }


        return redirect()->route('mails.received.index')->with('success', 'Mail créé avec succès.');
    }




    public function show(Mail $mail)
    {
        return view('mails.received.show', compact('mail'));
    }



    public function edit(Mail $mail)
    {
        $mailPriorities = MailPriority::all();
        $mailTypologies = MailTypology::all();
        return view('mails.received.edit', compact('mail', 'mailPriorities', 'mailTypologies'));
    }


    public function update(Request $request, Mail $mail)
    {
        $mail->update($request->all());

        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $path = $document->store('mail_attachments');
            $mailAttachment = MailAttachment::create([
                'path' => $path,
                'filename' => $document->getClientOriginalName(),
                'size' => $document->getSize(),
            ]);
            $mail->mailAttachment()->associate($mailAttachment);
        }

        return redirect()->route('mails.received.index')->with('success','Mail updated successfully');
    }


    public function destroy(Mail $mail)
    {
        $mail->delete();
        return redirect()->route('mails.received.index')->with('success','Mail deleted successfully');
    }
}


