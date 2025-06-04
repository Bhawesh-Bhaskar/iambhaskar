<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {        
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        return view('admin.pages.ticket.index')->with(['title'=>'Tickets List', 'tickets'=>$tickets]);
    }
    
    public function create()
    {
        $admins = Admin::where('status', '1')->orderBy('created_at', 'desc')->get();
        $users = User::where('status', '1')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.ticket.create')->with(['title' => 'Add Ticket', 'admins'=>$admins, 'users'=>$users]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',            
            'status' => 'required',
        ]);
    
        try {
            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/tickets');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }
    
            $slug = Str::slug($request->input('subject'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (Ticket::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
                
            $rs = Ticket::create([
                'subject' => $request->input('subject'),                
                'slug' => $slug,
                'message' => $request->input('message'),
                'assignee' => $request->input('assignee'),
                'user_id' => $request->input('user_id'),
                'status' => $request->input('status'),
                'read_status' => 'unread',                
                'code' => 'TIC-' . Str::random(6),
                'priority' => $request->input('priority'),
                'type' => $request->input('type'),
                'image' => $file,
            ]);
            
            if ($rs) {
                $message = array('flag' => 'alert-success', 'message' => 'Ticket Created Successfully');
                return redirect()->route('admin.ticket.index')->with(['message' => $message]);    
            }
    
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to Create Ticket, Please try again');
            return redirect()->route('admin.ticket.index')->with(['message' => $message]); 
        } catch (Exception $e) {
            $message = array('flag' => 'alert-danger', 'message' => $e->getMessage());
            return back()->with(['message' => $message]);
        }
    }   

    public function edit(Request $request, $slug)
    {
        try
        {           
            $ticketData = Ticket::where('slug', $slug)->first();           
            if(empty($ticketData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Ticket found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.ticket.edit')->with(['ticketData'=>$ticketData, 'title'=>'Edit Ticket']);            
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',            
            'status' => 'required',
        ]);
              
        try 
        { 
            $ticket = Ticket::where('slug', $slug)->first();
            if ($request->hasFile('image') && $request->image->isValid()) {
                if ($ticket->image && file_exists(public_path('assets/img/tickets/'.$ticket->image))) {
                    unlink(public_path('assets/img/tickets/'.$ticket->image));
                }
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/tickets');
                $request->image->move($destinationPath, $file);                
            } else {
                $file = $ticket->image;
            } 
            
            $data = [
                'subject' => $request->input('subject'), 
                'message' => $request->input('message'),
                'status' => $request->input('status'),
                'priority' => $request->input('priority'),
                'type' => $request->input('type'),
                'image' => $file,
            ];
         
            $rs = Ticket::where(['slug'=> $slug])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Ticket updated successfully.');
                return redirect()->route('admin.ticket.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update ticket, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }    
    
    public function delete(Request $request, $id)
    {
        try 
        {
            $rs = Ticket::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Ticket Deleted Successfully');
                return redirect()->route('admin.ticket.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete ticket, Please try again');
            return redirect()->route('admin.ticket.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }

    public function reply(Request $request, $slug)
    {
        try
        {           
            $ticketData = Ticket::where('slug', $slug)->first();           
            if(empty($ticketData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Ticket found with provided id');
                return back()->with(['message'=>$message]);
            }

            Ticket::where('slug', $slug)->update(['read_status' => 'read']);
            TicketReply::where(['ticket_id' => $ticketData->id])->update(['read_status' => 'read']);
            $ticket_replies = TicketReply::where(['ticket_id' => $ticketData->id])->orderBy('id', 'desc')->get();
            
            return view('admin.pages.ticket.reply')->with(['ticketData'=>$ticketData, 'title'=>'Reply Ticket', 'ticket_replies'=>$ticket_replies]);            
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function replyStore(Request $request, $id)
    {
        $request->validate([
            'message' => 'required'
        ]);
    
        try {
            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/tickets');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }

            $ticket = Ticket::where('id', $id)->first();

            Ticket::where('id', $id)->update([
                'status' => $request->status,
                'last_reply' => date('Y-m-d H:i:s'),
            ]);
                    
            $rs = TicketReply::create([
                'assignee' => $ticket->assignee,
                'user_id' => $ticket->user_id,
                'ticket_id' => $ticket->id,
                'message' => $request->input('message'),
                'user_type' => 'admin',
                'read_status' => 'unread',
                'image' => $file,
            ]);
            
            if ($rs) {
                $message = array('flag' => 'alert-success', 'message' => 'Ticket Reply Created Successfully');
                return redirect()->route('admin.ticket.index')->with(['message' => $message]);    
            }
    
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to Create Ticket Reply, Please try again');
            return redirect()->route('admin.ticket.index')->with(['message' => $message]); 
        } catch (Exception $e) {
            $message = array('flag' => 'alert-danger', 'message' => $e->getMessage());
            return back()->with(['message' => $message]);
        }
    } 
}