<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Raffle;

class RafflesController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkroles:PRESIDENT|COORDINATOR|REGISTER_COORDINATOR');
    }
    public function list()
    {
        $instance = \Instantiation::instance();

        $raffles = Raffle::all();

        return view('raffle.list',
            ['instance' => $instance, 'raffles' => $raffles]);
    }

    public function view($instance,$id)
    {
        $instance = \Instantiation::instance();
        $raffle = Raffle::find($id);

        return view('raffle.view',
            ['instance' => $instance, 'raffle' => $raffle]);
    }

    public function raffle($instance, $id)
    {
        $instance = \Instantiation::instance();
        $raffle = Raffle::find($id);

        $candidates = Attendee::where(['event_id'=> $raffle->event->id])->get();
        
        $mensaje = 'No hay ningún asistente a este evento todavía';

        $estado = 'error';
        
        if(isset($raffle->winner_id)){
            $mensaje = 'Este sorteo ya tiene ganador';
        }else{

            if(count($candidates) != 0){
                $selected = $candidates[rand(0, count($candidates))];

                $raffle->winner_id = $selected->user_id;

                $raffle->save();

                $mensaje = 'Ya tenemos ganador!';

                $estado = 'success';
            }
        }
        return redirect()->route('raffle.view', ['instance' => $instance, 'id' => $raffle->id])->with($estado, $mensaje);;
    }

    /****************************************************************************
     * CREATE A RAFFLE
     ****************************************************************************/

    public function create()
    {
        $instance = \Instantiation::instance();
        $events = Event::all();

        return view('raffle.createandedit', ['route_publish' => route('raffle.publish',$instance),
                                                'instance' => $instance, 
                                                'events' => $events]);
    }

    public function publish(Request $request)
    {
        return $this->new($request,"PENDING");
    }

    private function new($request,$status)
    {

        $instance = \Instantiation::instance();

        $raffle = $this->new_raffle($request,$status);

        return redirect()->route('raffle.view', ['instance' => $instance, 'id' => $raffle->id])->with('success', 'Sorteo creado con éxito.');

    }

    private function new_raffle($request,$status)
    {

        $request->validate([
            'title' => 'required|min:5|max:255',
            'prize' => 'required|min:5|max:255',
        ]);

        // creación de un nuevo sorteo
        $raffle = Raffle::create([
            'title' => $request->input('title'),
            'prize' => $request->input('prize'),
            'event_id' => $request->input('event')
        ]);

        $raffle->save();

        return $raffle;
    }

}