<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carta;
use App\Models\Categoria;
use App\Models\Cambio;
use Auth;
use PhpParser\Node\Expr\Cast\String_;

class Game extends Controller
{

    public function getData(Request $request)
    {
        $cartas = Carta::where('users_id', Auth::user()->id)->get();
        $categorias = Categoria::where('users_id', Auth::user()->id)->get();
        $cambios = Cambio::where('users_id', Auth::user()->id)->get();

        $res = [
            "cartas" => $cartas,
            "categorias" => $categorias,
            "cambios" => $cambios
        ];

        return response($res, 201);
    }

    public function cambios(Request $request)
    {

        $cambios = Cambio::where('users_id', Auth::user()->id)->get();
        $cambios_enviados =  json_decode($request->input("cambios"))->cambios;

        if (count($cambios) > 0) {
            for ($i = 0; $i < count($cambios); $i++) {
                $cambios[$i]["fecha"] = strtotime($cambios[$i]["fecha"]);
                $aux2[$i] =  strtotime($cambios[$i]["fecha"]);
            }
            array_multisort($aux2, SORT_DESC, $cambios);
        } else {

            foreach ($cambios_enviados as $key => $cambio) {
                $tabla   =  $cambio["tabla"];
                $accion  =  $cambio["accion"];
                $fecha   =  $cambio["fecha"];
                $contenido = $cambio["contenido"];

                switch ($tabla) {
                    case 'Cartas':
                        $res = Carta::create([
                            'users_id' => Auth::user()->id,
                            'titulo' => $contenido["titulo"],
                            'reto' => $contenido["reto"],
                            'castigo' => $contenido["castigo"]
                        ]);

                        break;
                    case 'Categorias':
                        $res = Categoria::create([
                            'users_id' => Auth::user()->id,
                            'titulo' => $contenido["titulo"],
                        ]);
                        break;
                    case 'Carta_Categoria':
                        
                        

                        break;
                    default:
                        # code...
                        break;
                }
            }


            $res = [
                "type" => 1,
                "aplciado" => $cambios_enviados
            ];
            return response($res, 201);
        }

        if (count($cambios_enviados) > 0) {
            for ($i = 0; $i < count($cambios_enviados); $i++) {
                $cambios_enviados[$i]["fecha"] = strtotime($cambios_enviados[$i]["fecha"]);
                $aux[$i] =  strtotime($cambios_enviados[$i]["fecha"]);
            }
            array_multisort($aux, SORT_DESC, $cambios_enviados);
        } {

            return response($this->getAll(), 201);
        }

        $this->generarSolicitud($cambios, $cambios_enviados);
    }

    public function getShare()
    {
        return "hi";
    }

    public function getAll()
    {
        $cartas = Carta::where('users_id', Auth::user()->id)->get();
        $categorias = Categoria::where('users_id', Auth::user()->id)->get();
        $cambios = Cambio::where('users_id', Auth::user()->id)->get();

        return [
            "type" => 0,
            "cartas" => $cartas,
            "categorias" => $categorias,
            "cambios" => $cambios
        ];
    }

    public function generarSolicitud($cambios, $cambios_enviados)
    {
        $bace = (count($cambios) < count($cambios_enviados)) ? $cambios_enviados : $cambios;
    }
}
