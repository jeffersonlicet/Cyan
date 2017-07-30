<?php

namespace App\Http\Controllers;

use App\Models\User,
    Validator,
    Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new user.
     *
     * @return void
     */
    public function create(Request $request)
    {
        $data = $request->only(['carnet', 'first_name', 'last_name', 'nick_name']);
        
        $data['carnet'] = preg_replace('/[^0-9]/', '', $data['carnet']);

        $firewall = Validator::make($data, [
            'carnet' => 'required|unique:users',
            'nick_name' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
        ], 
        [   'required' => 'El campo :attribute es obligatorio',
            'carnet.unique' => 'El carnet ya se encuentra registrado',
            'nick_name.unique' => 'El apodo ya se encuentra registrado',
        ]);

        if(!$firewall->passes())
        {
            return response()->json([
                'status' => FALSE, 
                'report' => $firewall->messages()->first()
            ]);
        }

        $user = new User();
        $user->carnet = $data['carnet'];

        if($this->invalidString(trim($data['first_name'])))
        {
            return response()->json([
                'status' => FALSE, 
                'report' => 'Tu nombre no puede contener caracteres especiales'
            ]);
        }

        if($this->invalidString(trim($data['last_name'])))
        {
            return response()->json([
                'status' => FALSE, 
                'report' => 'Tu apellido no puede contener caracteres especiales'
            ]);
        }

        if($this->invalidString(trim($data['nick_name'])))
        {
            return response()->json([
                'status' => FALSE, 
                'report' => 'Tu nombre de usuario no puede contener caracteres especiales'
            ]);
        }
        
        $user->first_name = $this->cleanText($data['first_name']);
        $user->last_name  = $this->cleanText($data['last_name']);
        $user->nick_name  = $this->cleanText($data['nick_name']);

        $user->save();

        return response()->json(['status' => true]);
    }

    /**
     * Check user before send to status view
     *
     * @return void
     */
    public function getStatus(Request $request)
    {
        $data = $request->only(['carnet']);
        $data['carnet'] = preg_replace('/[^0-9]/', '', $data['carnet']);

        if($user = User::where(['carnet' => $data['carnet']])->first())
        {
            if($user->user_status == 1)
            {
                return response()->json([
                    'status' => TRUE, 
                    'id' => $user->user_id
                ]);

            } else $report = 'Tu cuenta no está activada';

        } else $report = 'Este usuario no existe';

        return response()->json([
            'status' => FALSE, 
            'report' => $report
        ]);
    }

    /**
     * Display the user status and available tickets/routes
     *
     * @return void
     */
    public function userStatus($userId = 0)
    {
        return view('status', ['user' => User::with('tickets', 'tickets.route')->find($userId)]); 
    }

    /**
     * Form to create a new user.
     *
     * @return void
     */
    public function form()
    {
        return view('create');
    }

    /**
     * Show the user status form
     *
     * @return void
     */
    public function status()
    {
        return view('statusform');
    }

    /**
     * Search for special chars
     *
     * @return boolean
     */
    private function invalidString($text)
    {
        return preg_match('/[^A-Za-z0-9üÀ-ÖØ-öø-ÿ]/', $text);
    }

    /**
     * Remove spaces
     *
     * @return void
     */
    private function cleanText($text)
    {
        return trim($text);
    }
}
