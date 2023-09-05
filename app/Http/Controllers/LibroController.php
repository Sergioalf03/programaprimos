<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{

    // función para recuperar la lista
    public function getList(Request $request)
    {
        $autor = new Libro;
        $autorResult = $autor::join('autors', 'autors.id', '=', 'libros.id_autor')
            ->select(
                'titulo',
                'anio',
                'descripcion',
                DB::raw('CONCAT(autors.nombre, " ", autors.apellido) AS autor'),
            )
            ->get();


        // select * from libros;

        // JOIN, INNER JOIN, LEFT JOIN, RIGHT JOIN, FULL JOIN



        return response()->json([
            'code' => 200,
            'result' => $autorResult,
        ]);
    }

    // función para recuperar un libro
    public function getOne(Request $request, $id) {
        $autor = new Libro;

        $autorExists = $autor::where('id', $id)
            ->select(
                'id',
                'titulo',
                'anio',
                'descripcion',
            )
            ->first();
            // SELECT id, titulo, anio, descripcion FROM libros WHERE id = ? LIMIT 1;

        if (!isset($autorExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El libro no existe',
            ]);
        }

        return response()->json([
            'code' => 200,
            'result' => $autorExists,
        ]);
    }

    // función para guardar un libro
    public function save(Request $request)
    {
        $autor = new Libro;
        $autorResult = $autor::create([
            'titulo' => $request['title'],
            'anio' => $request['year'],
            'descripcion' => $request['desc'],
            'id_autor' => $request['autor_id'], // Debe de existir en la tabla autor
        ]); // insert into autors (nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?);

        return response()->json([
            'code' => 200,
            'result' => $autorResult['id'],
        ]);
    }

    // función para actualizar un libro
    public function update(Request $request, $id)
    {
        $autor = new Libro;

        $autorExists = $autor::where('id', $id)
            ->first();

        if (!isset($autorExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El libro no existe',
            ]);
        }

        $autorResult = $autorExists->fill([
            'titulo' => $request['title'],
            'anio' => $request['year'],
            'descripcion' => $request['desc'],
            'id_autor' => $request['autor_id'], // Debe de existir en la tabla autor
        ])->save(); // update autors  set nombre=?, apellido=?, fecha_nacimiento=? where id = ?;

        return response()->json([
            'code' => 200,
            'message' => 'Se actualizó correctamente',
        ]);
    }

    // función para eliminar un libro
    public function delete(Request $request, $id)
    {
        $autor = new Libro;

        $autorExists = $autor::where('id', $id)
            ->first();

        if (!isset($autorExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El libro no existe',
            ]);
        }

        $autorResult = $autor::where('id', $id)
            ->delete(); // delete from autors where id = ?;

        return response()->json([
            'code' => 200,
            'message' => 'Se borró correctamente',
        ]);
    }

    // función para obtener los datos del autor del libro
    // mandar el id libro -> el nombre del autor

    public function getAuthor(Request $request, $idLibro) {
        $libro = new Libro;
        $libroExists = $libro::where('id', $idLibro)
            ->first();

        if (!isset($libroExists)) {
            return response()->json([
                'code' => 200,
                'message' => 'El libro no existe',
            ]);
        }

        $autor = new Autor;
        $autorExists = $autor::where('id', $libroExists['id_autor'])
            ->select(
                'nombre',
                'apellido',
            )
            ->first();

        // if (!isset($autorExists)) {
        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'El autor no existe',
        //     ]);
        // }

        return response()->json([
            'code' => 200,
            'result' => $autorExists,
        ]);
    }

}
