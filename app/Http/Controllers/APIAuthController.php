<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class APIAuthController extends Controller {
    public function register(Request $request) {

        //se valida la información que viene en $request
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80',
            'password' => 'required|string|min:8'
        ]);

        //se crea el usuario en la base de datos
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        //se crea token de acceso personal para el usuario
        $token = $this->generateToken($user);

        //se devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request) {

        //valida las credenciales del usuario
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid access credentials'. $request['email']. " -> ". $request['password']
            ], 401);
        }

        //Busca al usuario en la base de datos
        $user = User::where('email', $request['email'])->firstOrFail();

        //Genera un nuevo token para el usuario
        $token = $this->generateToken($user);

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request) {
        //auth('sanctum')->user()->tokens()->delete();
        //$request->user()->tokens()->delete();
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $token->tokenable->tokens()->delete();
        return response()->json([
            'done' => true,
            'message' => 'Sesion cerrada'
        ]);
    }

    public function valid(Request $request) {
        if(is_null($request->user())) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid auth token'
            ]);
        }
        if($request->user()->currentAccessToken()->token != $request->bearerToken()) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid auth token'
            ]);
        }
    }

    private function generateToken(User $user) {
        return $user->createToken(
            'auth_token',
            ['*'],
            now()->addHours(2)
            )->plainTextToken;
    }
}
