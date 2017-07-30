<?php

namespace App\Http\Controllers;

use Carbon\Carbon,
    App\Models\User,
    App\Models\Route,
    App\Models\Ticket,
    Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Get routes index
     *
     * @return void
     */
    public function index()
    {
        return view('app', ['routes' => Route::with('Tickets')->orderBy('open_at', 'DESC')->get()]);
    }

    /**
     * Generate a ticket
     *
     * @return void
     */
    public function ticket(Request $request)
    {
        $passenger = $request->only(['route_id', 'carnet']);
        $passenger['carnet'] = preg_replace('/[^0-9]/', '', $passenger['carnet']);

        if(($route = Route::find($passenger['route_id'])) && ($user = User::where(['carnet' => $passenger['carnet'], 'status' => 1])->first()))
        {
            if($route->is_open)
            {
                $ticket = Ticket::where(['user_id' => $user->user_id, 'route_id' => $route->route_id])->where('created_at', '>=', Carbon::today()->toDateString())->first();
               
                if(!$ticket)
                {
                    $ticket = new Ticket();
                    $ticket->user_id = $user->user_id;
                    $ticket->route_id = $route->route_id;
                    $ticket->save();

                    return response()->json(['status' => TRUE]);

                } else $error = 'Ya estás anotado';

            } else $error = 'La lista está cerrada';

        } else
        {
            $error = 'Tu cuenta no está activada';
        } 

        return response()->json(['status' => FALSE, 'report' => $error]);
    }

    /**
     * Get a single route index
     *
     * @return void
     */
    public function single($routeId)
    {
        $route = Route::with('Tickets')->find($routeId);
        return view('route', ['route' => $route]);
    }
}
