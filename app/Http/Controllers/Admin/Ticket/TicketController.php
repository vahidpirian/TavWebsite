<?php

namespace App\Http\Controllers\admin\ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function newTickets()
    {
        if (!auth()->user()->ticketAdmin){
            return back()->with('swal-error', 'شما به بخش تیکت ها دسترسی ندارید');
        }
        $tickets = Ticket::where('seen', 0)->whereNull('ticket_id')->latest()->get();
        foreach ($tickets as $newTicket) {
            $newTicket->seen = 1;
            $result = $newTicket->save();
        }
        return view('admin.ticket.index', compact('tickets'));
    }

    public function openTickets()
    {
        if (!auth()->user()->ticketAdmin){
            return back()->with('swal-error', 'شما به بخش تیکت ها دسترسی ندارید');
        }
        $tickets = Ticket::where('status', 0)->whereNull('ticket_id')->latest()->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function closeTickets()
    {
        if (!auth()->user()->ticketAdmin){
            return back()->with('swal-error', 'شما به بخش تیکت ها دسترسی ندارید');
        }
        $tickets = Ticket::where('status', 1)->whereNull('ticket_id')->latest()->get();
        return view('admin.ticket.index', compact('tickets'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ticketAdmin){
            return back()->with('swal-error', 'شما به بخش تیکت ها دسترسی ندارید');
        }
        $tickets = Ticket::whereNull('ticket_id')->latest()->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if (!auth()->user()->ticketAdmin){
            return back()->with('swal-error', 'شما به بخش تیکت ها دسترسی ندارید');
        }
        return view('admin.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function answer(TicketRequest $request, Ticket $ticket)
    {
        $ticketAdmin = auth()->user()->ticketAdmin ?? TicketAdmin::first();

        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $ticketAdmin->id;
        $inputs['user_id'] = $ticket->user_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        $inputs['is_admin'] = 1;

        $ticket = Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $result = $ticket->save();
        return redirect()->route('admin.ticket.index')->with('swal-success', 'تغییر شما با موفقیت حذف شد');
    }
}
