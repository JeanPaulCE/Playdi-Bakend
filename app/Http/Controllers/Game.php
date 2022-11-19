<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carta;
use App\Models\Categoria;
use App\Models\Cambio;
use App\Models\User;
use Auth;
use PhpParser\Node\Expr\Cast\String_;
use PhpParser\Node\Stmt\Switch_;

class Game extends Controller
{


    public function validate_(Request $request)
    {
        $res = ["res" => "200"];
        return response($res, 201);
    }


    //!!Pruebas requeridas
    public function cambios(Request $request)
    {
        //peticion sin contenido retorna todos los datos
        if (!$request->has("cambios")) return response($this->getAll(), 200);

        $cambios = Cambio::where('users_id', Auth::user()->id)->get();
        $cambios_enviados =  json_decode($request->input("cambios"))->cambio;
        $cartas_enviados =  json_decode($request->input("cambios"))->cartas;
        $categorias_enviados =  json_decode($request->input("cambios"))->categorias;


        //peticion con contenido y base de datos limpa guarda todo lo enviado 
        if (count($cambios) <= 0) {

            $this->aplyChanges("categorias", $categorias_enviados);
            $this->aplyChanges("cartas", $cartas_enviados);

            $cambio = new Cambio;

            $cambio->users_id = Auth::user()->id;
            $cambio->tabla = $cambios_enviados->tabla;
            $cambio->id_relacionado = $cambios_enviados->id_relacionado;
            $cambio->accion = $cambios_enviados->accion;
            $cambio->fecha =  $cambios_enviados->fecha;
            $cambio->save();

            $res = [
                "type" => 1
            ];
            return response($res, 200);
        }

        //si hay mas de un cambio local ordena de reciente a antiguo
        if (count($cambios) > 1) {
            for ($i = 0; $i < count($cambios); $i++) {
                $cambios[$i]["fecha"] = strtotime($cambios[$i]["fecha"]);
                $aux2[$i] =  strtotime($cambios[$i]["fecha"]);
            }
            array_multisort($aux2, SORT_DESC, $cambios);
        }


        //si lo enviado y lo ya almacenado es lo mismo
        if ($cambios[0]->fecha == $cambios_enviados->fecha) {
            $res = [
                "type" => 2
            ];
            return response($res, 200);
        }

        $fecha_local = $cambios[0]->fecha;
        $fecha_remota = $cambios_enviados->fecha;

        //lo enviado es mas antiguo que lo guardado, se retorna lo guardado
        if ($fecha_local > $fecha_remota) {
            return response($this->getAll(), 204);
        } else {
            //lo enviado es mas reciente que lo guardado, se sustitulle lo guardado por lo enviado
            $this->aplyChanges("categorias", $categorias_enviados);
            $this->aplyChanges("cartas", $cartas_enviados);
            $cambio = new Cambio;

            $cambio->users_id = Auth::user()->id;
            $cambio->tabla = $cambios_enviados->tabla;
            $cambio->id_relacionado = $cambios_enviados->id_relacionado;
            $cambio->accion = $cambios_enviados->accion;
            $cambio->fecha = $cambios_enviados->fecha;
            $cambio->save();


            $res = [
                "type" => 1
            ];
            return response($res, 200);
        }
    }

    //!!!!implementar tabla
    public function makeShare(Request $request)
    {
        $categoria_recibida = $cambios_enviados =  json_decode($request->input("categoria"));
        $compartido = new Compartido; //::where("codigo", $codigo)->where("nombre", $nombre);
        $compartido->codigo =  substr((time() + ""), -5) + rand(10, 99);
        $compartido->nombre =  Auth::user()->name;
        $compartido->users_id = Auth::user()->id;
        $compartido->id_categoria = Categoria::where('users_id',  Auth::user()->id)->where('titulo', $categoria_recibida->titulo)->first()->id;
        $compartido->save();
        return response($compartido, 201);
    }

    //!!!!implementar tabla
    public function getShare(Request $request)
    {
        $nombre =  $request->input("nombre");
        $codigo =  $request->input("codigo");

        $compartido = Compartido::where("codigo", $codigo)->where("nombre", $nombre);
        $idCategoria =  $compartido->id_categoria;
        $categoria = Categoria::where("id", $idCategoria)->first();
        $cartas = $categoria->cartas();

        $nCategoria = new Categoria;
        $nCategoria->users_id = Auth::user()->id;
        $nCategoria->titulo = $categoria->titulo;
        $nCategoria->save();

        foreach ($cartas as $key => $value) {
            $carta = new Carta;
            $carta->users_id = Auth::user()->id;
            //$carta->global_ID = $datos[$i]->global_ID;
            $carta->titulo = $value->titulo;
            $carta->reto = $value->reto;
            $carta->castigo = $value->castigo;
            $carta->save();
            $category = Categoria::where('users_id',  Auth::user()->id)->where('titulo', $nCategoria->titulo)->first();
            $carta->categorias()->attach($category);
        }

        return response($this->getAll(), 201);
    }

    private function getAll()
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

    private function aplyChanges($tabla, $datos)
    {
        switch ($tabla) {
            case 'cartas':
                Carta::where('users_id',  Auth::user()->id)->delete();
                break;
            case 'categorias':
                Categoria::where('users_id',  Auth::user()->id)->delete();
                break;
            default:
                # code...
                break;
        }
        for ($i = 0; $i < count($datos); $i++) {
            switch ($tabla) {
                case 'cartas':
                    $carta = new Carta;
                    $carta->users_id = Auth::user()->id;
                    //$carta->global_ID = $datos[$i]->global_ID;
                    $carta->titulo = $datos[$i]->titulo;
                    $carta->reto = $datos[$i]->reto;
                    $carta->castigo = $datos[$i]->castigo;
                    $carta->save();

                    foreach ($datos[$i]->Categorias as $key => $value) {
                        $category = Categoria::where('users_id',  Auth::user()->id)->where('titulo', $value->titulo)->first();
                        $carta->categorias()->attach($category);
                    }


                    break;
                case 'categorias':
                    $categoria = new Categoria;
                    $categoria->users_id = Auth::user()->id;
                    $categoria->titulo = $datos[$i]->titulo;
                    $categoria->save();
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
}
