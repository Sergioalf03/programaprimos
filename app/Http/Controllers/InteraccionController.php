<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteraccionController
{

    public function HolaMundo() {
        return response()->json([
            'code' => 200,
            'message' => 'Hola Mundo',
        ]);
    }

    public function HolaMundoConNombre($name)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Hola ' . $name,
        ]);
    }

    public function MensajePersonalizado(Request $body)
    {
        return response()->json([
            'code' => 200,
            'message' => $body['mensaje'],
        ]);
    }

    public function sumaYRestaPorParametros(Request $request, $numero1, $numero2) {
        return response()->json([
            'code' => 200,
            'result' => [
                'suma' => $numero1 + $numero2,
                'resta' => $numero1 - $numero2,
            ],
        ]);
    }

    public function sumaYRestaPorBody(Request $request) {
        $sumaTotal = 0;
        $restaTotal = 0;

        //  0  10   5   3   8   A   %
        // a1, a2, a3, a4, a5, a6, a7

        $arreglo = [ 10, 5, 3, 8 ];
        $arreglo[0];

        // try {
        //     Integer.parseInt("hola")
        // } catch (Exception $exeption) {
        //     echo('No es un numero');
        // }

        // $arreglo.length();
        // $arreglo.len;

        $longitud = count($arreglo); // 4

        for ($i = 0; $i < count($arreglo); $i++) {
            $sumaTotal += $request['numeros'][$i];
            $restaTotal -= $request['numeros'][$i];
        }
        return response()->json([
            'code' => 200,
            'result' => [
                'suma' => $sumaTotal,
                'resta' => $restaTotal,
            ],
        ]);
    }

    public function mayorEdad(Request $request, $edad) {

        // if ($edad >= 18) {
        //     return response()->json([
        //         'code' => 200,
        //         'result' => true,
        //     ]);
        // } else {
        //     return response()->json([
        //         'code' => 200,
        //         'result' => false,
        //     ]);
        // }

        // $esMayor = false;

        // if ($edad >= 18) {
        //     $esMayor = true;
        // }

        // return response()->json([
        //     'code' => 200,
        //     'result' => $esMayor,
        // ]);

        // $edad = 20;

        // $esMayor = $edad >= 18;

        // return response()->json([
        //     'code' => 200,
        //     'result' => $esMayor,
        // ]);

        return response()->json([
            'code' => 200,
            'result' => $this->esMayor($request, $edad)['result'],
        ]);
    }

    public function esMayor(Request $request, $numero) {
        return [ 'result' => $numero > 17 ];
    }

    public function tabla10(Request $request, $numero, $limite) {
        $arreglo = [];

        for ($i = 0; $i < $limite; $i++) {
            array_push($arreglo, $numero * ($i + 1));
        }

        return response()->json([
            'code' => 200,
            'result' => $arreglo,
        ]);
    }

    // Envíar dos números y recibir la suma y la resta de ambos   10, 4 => 14, 6
    // Enviar una edad y recibir si es mayor de edad    7 => false o 26 => true
    // Enviar un número y recibir su tabla de multiplicar del 1 al 10   8 => [8, 16, 24, 32, ... , 80]

    // Envíar dos números y recibir la suma y la resta de ambos   10, 4 => 14, 6
    public function sumayresta( $num1, $num2){

        $suma = $num1 + $num2;
        $resta = $num1 - $num2;
        $escribir[] = array(
            '1. ' => "La suma de " . $num1 . " + " . $num2 . " es igual a :" . $suma ,
            '2. ' => "La resta de " . $num1 . " - " . $num2 . " es igual a :" . $resta
        );

        return response()->json([
            'code' => 200,
            'massage' => $escribir
        ]);
    }

    // Enviar una edad y recibir si es mayor de edad    7 => false o 26 => true
    public function edad( $edad){

        $status = "True";
        $status1 = "False";
            if($edad >= 18 ){
                echo $status;
            } else{
                echo $status1;
            }

            return response()->json([
                'code' => 200,
                'massage' => $edad,
            ]);
    }

    // Enviar un número y recibir su tabla de multiplicar del 1 al 10   8 => [8, 16, 24, 32, ... , 80]
    public function tablasdemultiplicar( $numero){

        for ($i = 1; $i <= 10; $i++) {
            $resultado = $numero * $i;
            $tabla[] = array(
                'multiplicacion' => $numero . " * " . $i . " = " . $resultado
            );
        }
        return response()->json([
            'code' => 200,
            'massage' => $tabla,
        ]);
    }

    // {
    //     "nombre": "Sergio",
    //     "apellido": "Alfaro"
    // }

}
