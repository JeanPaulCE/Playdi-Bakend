<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\Categoria;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $fields = $validateUser->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken', now()->addSeconds(10));



        $categoria = new Categoria;
        $categoria->users_id = $user->id;
        $categoria->titulo = "Clásico";
        $categoria->save();



        $cartas = [
            ["titulo" => "Baila y baila", "reto" => "Baila una coreografía original que dure entre 15 a 30 segundos con la música que elija quien está a tu derecha", "castigo" => "Recita un poema al estilo de Pablo Neruda"],
            ["titulo" => "¿Qué viste?", "reto" => "Di cuatro cosas que pensaste la primera vez que viste a la persona de tu izquierda, s TOTALMENTE sinceras", "castigo" => "Que la persona elija tu castigo por no contestar"],
            ["titulo" => "¿Amigos = Ayuda?", "reto" => "Debes llamar a uno de tus contactos y decirle que ocupas su ayuda (inventa una historia creativa) Para ganar la persona debe de decir que te ayudara", "castigo" => "Recibir 5 nalgadas por parte de la persona que elija el grupo"],
            ["titulo" => "¿Creativo?... Tal vez", "reto" => "Di el nombre de la persona que peor te cae de la sala y porqué. Sinceridad, ante. todo", "castigo" => "Tomar un vaso con salsa Lizano, consomé, azúcar, chile y chocolate. Los otros jugadores pueden incluir o quitar productos"],
            ["titulo" => "Declaraciones", "reto" => "Llama por teléfono a un ser querido y tienes que hacerle una confesión acordada con el resto de jugadores", "castigo" => "Llama a tu ex (el grupo elije a cual) y dile que a pesar de todo lo quieres"],
            ["titulo" => "¿Pero qué está pasando?", "reto" => "Sal a la calle y grita lo más fuerte que puedas", "castigo" => "Haz 50 flexiones sin parar en un minuto, si fallar lo tienes que repetir una vez más"]
        ];

        foreach ($cartas as $key => $carta) {
            $carta_ = new Carta;
            $carta_->users_id    =  $user->id;
            $carta_->titulo      =  $carta["titulo"];
            $carta_->reto        =  $carta["reto"];
            $carta_->castigo     =  $carta["castigo"];
        }




        $response = [
            'user' => $user,
            'token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expired_at
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('my-apptoken', Carbon::now()->addSeconds(10));

        $response = [
            'user' => $user,
            'token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expired_at
        ];

        return response($response, 201);
    }

    public function nan(Request $request)
    {

        $response = [
            'hi' => "5hi",
        ];
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
