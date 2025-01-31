<?php

namespace App\Http\Controllers\Site\MyAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\MyAccount\MyAccountTicketAnswerRequest;
use App\Http\Requests\Site\MyAccount\MyAccountTicketRequest;
use App\Http\Services\File\FileService;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketPriority;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyAccountTicketController extends Controller
{
    use AuthorizesRequests;

    protected function getUser()
    {
        return Auth::user();
    }

    public function index(Request $request)
    {
        $query = $this->getUser()->tickets();
        if ($request->has('status')){
            $query->where('status', $request->get('status') == 'open' ? 0 : 1);
        }

        $tickets = $query->with(['priority', 'category'])
            ->latest()
            ->whereNull('ticket_id')
            ->simplePaginate(10);

        return view('site.my-account.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $priorities = TicketPriority::where('status', 1)->get();
        $categories = TicketCategory::where('status', 1)->get();
        return view('site.my-account.tickets.create', compact('priorities', 'categories'));
    }

    public function store(MyAccountTicketRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        $inputs['reference_id'] = TicketAdmin::inRandomOrder()->first()->id;

        $ticket = Ticket::create($inputs);

        if ($request->hasFile('file')) {
            if (!$request->file('file')->isValid()) {
                return redirect()->back()->with('error', 'فایل آپلود شده معتبر نیست.');
            }

            try {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/ticket-files', $fileName, 'public');

                if (!$filePath) {
                    return redirect()->back()->with('error', 'آپلود فایل با خطا مواجه شد');
                }


                $ticket->file()->create([
                    'file_path' => $filePath,
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getClientMimeType(),
                    'user_id' => Auth::id(),
                ]);

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'خطا در آپلود فایل: ' . $e->getMessage());
            }
        }

        return redirect()->route('account.tickets.show', $ticket->id)
            ->with('success', 'تیکت شما با موفقیت ثبت شد');
    }

    public function show(Ticket $ticket)
    {
        if ($this->getUser()->id != $ticket->user_id){
            return back()->with('error','امکان انجام عملیات وجود ندارد');
        }

        $ticket->load(['children', 'category', 'priority', 'file']);
        return view('site.my-account.tickets.show', compact('ticket'));
    }

    public function reply(MyAccountTicketAnswerRequest $request, Ticket $ticket)
    {
        if ($this->getUser()->id != $ticket->user_id){
            return back()->with('error','امکان انجام عملیات وجود ندارد');
        }

        if($ticket->status === 1) {
            return redirect()->back()->with('error', 'این تیکت بسته شده است');
        }

        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        $inputs['ticket_id'] = $ticket->id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['reference_id'] = $ticket->reference_id;

        $reply = Ticket::create($inputs);

        if ($request->hasFile('file')) {
            if (!$request->file('file')->isValid()) {
                return redirect()->back()->with('error', 'فایل آپلود شده معتبر نیست.');
            }

            try {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/ticket-files', $fileName, 'public');

                if (!$filePath) {
                    return redirect()->back()->with('error', 'آپلود فایل با خطا مواجه شد');
                }

                $ticket->file()->create([
                    'file_path' => $filePath,
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getClientMimeType(),
                    'user_id' => Auth::id(),
                ]);

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'خطا در آپلود فایل: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'پاسخ شما با موفقیت ثبت شد');
    }

    public function close(Ticket $ticket)
    {
        if ($this->getUser()->id != $ticket->user_id){
            return back()->with('error','امکان انجام عملیات وجود ندارد');
        }


        $ticket->update(['status' => 1]);
        return redirect()->back()
            ->with('success', 'تیکت با موفقیت بسته شد');
    }
}
