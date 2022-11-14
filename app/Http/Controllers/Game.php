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

    public function validate_(Request $request)
    {
        $res = ["res" => "200"];
        return response($res, 201);
    }

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

        if (count($cambios_enviados) > 0) {
            for ($i = 0; $i < count($cambios_enviados); $i++) {
                $cambios_enviados[$i]["fecha"] = strtotime($cambios_enviados[$i]["fecha"]);
                $aux[$i] =  strtotime($cambios_enviados[$i]["fecha"]);
            }
            array_multisort($aux, SORT_DESC, $cambios_enviados);
        } {

            return response($this->getAll(), 201);
        }

        if (count($cambios) > 0) {
            for ($i = 0; $i < count($cambios); $i++) {
                $cambios[$i]["fecha"] = strtotime($cambios[$i]["fecha"]);
                $aux2[$i] =  strtotime($cambios[$i]["fecha"]);
            }
            array_multisort($aux2, SORT_DESC, $cambios);
        } else {

            $res = $this->aplyChanges($cambios_enviados);
            return response($res, 201);
        }

        $this->generarRequeridos($cambios, $cambios_enviados);
        $this->aplicacionSelectiva($cambios, $cambios_enviados);
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
    private function aplicacionSelectiva($cambios, $cambios_enviados)
    {
        for ($i=0; $i < count($cambios_enviados); $i++) { 
            
        }


    }
    private function generarRequeridos($cambios, $cambios_enviados)
    {
        $bace = (count($cambios) < count($cambios_enviados)) ? $cambios_enviados : $cambios;


    }

    private function aplyChanges($cambios)
    {
        for ($i = 0; $i < count($cambios); $i++) {

            $tabla   =   $cambios[$i]["tabla"];
            $accion  =   $cambios[$i]["accion"];
            $fecha   =   $cambios[$i]["fecha"];
            $contenido = $cambios[$i]["contenido"];



            switch ($tabla) {
                case 'Cartas':
                    $carta = new Carta;
                    $carta->users_id = Auth::user()->id;
                    $carta->titulo = $contenido["titulo"];
                    $carta->reto = $contenido["reto"];
                    $carta->castigo = $contenido["castigo"];
                    $carta->save();
                    $id = $carta->id;
                    for ($i = 0; $i < count($cambios[$i]["contenido"]["Categorias"]); $i++) {
                        $categoria = json_decode($cambios[$i]["contenido"]["Categorias"][$i]);
                        $categoria_ = Categoria::where("users_id", Auth::user()->id)->where("titulo", $categoria["titulo"])->get();
                        if (count($categoria_) > 0) {
                            $carta->categorias()->attach($categoria_[0]);
                        }
                    }

                    break;
                case 'Categorias':

                    $categoria = new Categoria;
                    $categoria->users_id = Auth::user()->id;
                    $categoria->titulo = $contenido["titulo"];
                    $categoria->save();
                    $id = $categoria->id;
                    break;
                default:
                    # code...
                    break;
            }

            $cambio = Cambio::create([
                "users_id"              =>  Auth::user()->id,
                'tabla'                 =>  $tabla,
                "id_Relacionado"        =>  $id,
                'accion'                =>  $accion,
                'fecha'                 =>  $fecha
            ]);
        }
    }
}
