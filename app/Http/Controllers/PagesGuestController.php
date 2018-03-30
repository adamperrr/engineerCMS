<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Mail\ContactMail;



class PagesGuestController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
    }

    public function index()
    {
        return redirect($this->websiteSettings['startPage']['value']);
    }

    public function listPages()
    {
        $pages = null;
        if(Auth::check())
        {
            $pages = Page::orderBy('order', 'asc')->get();
        }
        else
        {
            $pages = Page::where('pageVisibility','1')->orderBy('order', 'asc')->get();
        }

        return view('pages-guest.list-pages', [
            'pages' => $pages
        ]);
    }

    public function show(Page $page)
    {
        $id = $page->id;
        $subpages = \App\Subpage::where('page_id', $id)
        ->orderBy('order', 'asc')
        ->get();

        $view = view('pages-guest.show', [
            'page' => $page,
            'subpages' => $subpages
        ]);

        if($page->pageVisibility == 1)
        {
            return $view;
        }
        else
        {
            if(Auth::check())
            {
                return $view;
            }
            else
            {
                abort(403, 'Unauthorized action.');
            }
        }
    }

    public function sendEmail(Request $request)
    {
        $emailData = $request->emailData;

        $fromName = $emailData['fromName'];
        $fromEmail = $emailData['fromEmail'];
        $subject = $emailData['subject'];
        $message = $emailData['message'];

        $toEmail = $emailData['toEmail'];

        $contactMail = new ContactMail($fromName, $fromEmail, $subject, $message);

        Mail::to($toEmail)
            ->send($contactMail);

        $response = [
            'status' => 'success',
            'data' => 'ok',
        ];

        return response()->json($response);
    }

    public function getSubpageById(Request $request)
    {
        $subpageId = json_decode($request->subpageId);
        $subpage = \App\Subpage::where('id', $subpageId)->first();

        $response = [
            'status' => 'success',
            'data' => $subpage,
        ];

        return response()->json($response);
    }
}
