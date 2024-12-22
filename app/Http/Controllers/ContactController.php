<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact.form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create($request->all());

        Mail::raw(
            "Je hebt een nieuw bericht ontvangen via het contactformulier:\n\n" .
            "Naam: {$request->name}\n" .
            "E-mail: {$request->email}\n\n" .
            "Bericht:\n{$request->message}",
            function ($mail) use ($request) {
                $mail->to(env('MAIL_FROM_ADDRESS'))
                     ->subject('Nieuw bericht via contactformulier')
                     ->from(env('MAIL_FROM_ADDRESS'), 'Contactformulier');
            }
        );

        return redirect()->route('contact.show')->with('success', 'Je bericht is succesvol verzonden!');
    }

    public function adminIndex()
    {
        $messages = ContactMessage::all();
        return view('admin.contact.index', compact('messages'));
    }

    public function replyToMessage(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $message = ContactMessage::findOrFail($id);

        Mail::raw($request->reply, function ($mail) use ($message) {
            $mail->to($message->email)
                 ->subject('Antwoord op je bericht')
                 ->from(env('MAIL_FROM_ADDRESS'));
        });

        $message->update(['answered' => true]);

        return redirect()->route('admin.contact.index')->with('success', 'Antwoord succesvol verzonden!');
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Bericht succesvol verwijderd.');
    }
}
