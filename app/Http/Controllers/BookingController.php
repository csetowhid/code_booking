<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $currentTime = date('H:i:s');
        Booking::where('end_time','<',$currentTime)->update(array('status'=>0));

        // foreach($tables as $table){
        //    Booking::where('table_id',$table->table_id)->update(array('status'=>0));
        //    Booking::where('table_id',$table->table_id)->delete();
        
        // }

        $data['tables'] = Table::all();
        $data['bookings'] = Booking::all();
        return view('bookings.index',$data);
    }

    public function create($id)
    {
        $data['table_id'] = $id;
        return view('bookings.create',$data);
    }

    public function store(Request $request)
    {


        // $currentTime = date('H:i:s');

        $data = Booking::where('table_id',$request->get('table_id'))->where('status',1)->first();

        if(empty($data)){
            $booking = Booking::create([
                    'table_id' => $request->get('table_id'),
                    'user_id' => Auth::user()->id,
                    'date' => $request->get('date'),
                    'start_time' => $request->get('start_time'),
                    'end_time' => $request->get('end_time'),
            ]);
            Booking::where('table_id',$request->get('table_id'))
            ->where('end_time',$request->get('end_time'))
            ->update((array('status' => 1)));
            return redirect()->route('bookings.index');
        }else{
            if($request->get('start_time') > $data->end_time && $request->get('start_time') > $data->start_time){
                $booking = Booking::create([
                    'table_id' => $request->get('table_id'),
                    'user_id' => Auth::user()->id,
                    'date' => $request->get('date'),
                    'start_time' => $request->get('start_time'),
                    'end_time' => $request->get('end_time'),
            ]);
            Booking::where('table_id',$request->get('table_id'))
            ->where('end_time',$request->get('end_time'))
            ->update((array('status' => 1)));
            }else{
                // return redirect()->route('bookings.index');
                return back()->with('SUCCESS',__("Already Booked"));

            }
        }

    

        if(empty($booking)){
            return redirect()->back();
        }
        return redirect()->route('bookings.index')->with('SUCCESS',__("Booked Successfully"));


    }
}
