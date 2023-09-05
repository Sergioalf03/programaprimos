<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // CRUD - CREAR, LEER, ACTUALIZAR, ELIMINAR

    public function getList(Request $request) {
        $autor = new Autor;
        $autorResult = $autor::get(); // select * from autors;

        return response()->json([
            'code' => 200,
            'result' => $autorResult,
        ]);
    }

    public function getOne(Request $request, $id) {
        $autor = new Autor;

        $autorExists = $autor::where('id', $id)
            ->select(
                'id',
                'nombre',
                'apellido',
            )
            ->first();

        if (!isset($autorExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El autor no existe',
            ]);
        }

        return response()->json([
            'code' => 200,
            'result' => $autorExists,
        ]);
    }

    public function save(Request $request) {
        $autor = new Autor;
        $autorResult = $autor::create([
            'nombre' => $request['name'],
            'apellido' => $request['lastname'],
            'fecha_nacimiento' => $request['date'],
        ]); // insert into autors (nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?);

        return response()->json([
            'code' => 200,
            'result' => $autorResult['id'],
        ]);
    }

    public function update(Request $request, $id) {
        $autor = new Autor;

        $autorExists = $autor::where('id', $id)
            ->first();

        if (!isset($autorExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El autor no existe',
            ]);
        }

        $autorResult = $autorExists->fill([
            'nombre' => $request['name'],
            'apellido' => $request['lastname'],
            'fecha_nacimiento' => $request['date'],
        ])->save(); // update autors  set nombre=?, apellido=?, fecha_nacimiento=? where id = ?;

        return response()->json([
            'code' => 200,
            'message' => 'Se actualizó correctamente',
        ]);
    }

    public function delete(Request $request, $id) {
        $autor = new Autor;

        $autorExists = $autor::where('id', $id)
            ->first();

        if (!isset($autorExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El autor no existe',
            ]);
        }

        $autorResult = $autor::where('id', $id)
            ->delete(); // delete from autors where id = ?;

        return response()->json([
            'code' => 200,
            'message' => 'Se borró correctamente',
        ]);
    }
}
