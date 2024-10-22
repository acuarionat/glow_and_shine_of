<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catalogoController extends Controller
{
    public function mostrarCatalogoMaquillaje() {
        $productosMaquillaje = DB::table('producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->where('producto.categoria', 'Maquillaje')
            ->select('producto.*', 'imagen_producto.direccion_imagen')
            ->get();
        
        return view('Maquillaje', ['productos' => $productosMaquillaje]);
    }

    public function mostrarCatalogoJoyeria() {
        $productosJoyeria = DB::table('producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->where('producto.categoria', 'Joyería')
            ->select('producto.*', 'imagen_producto.direccion_imagen')
            ->get();
        
        return view('Joyeria', ['productos' => $productosJoyeria]);
    }


    public function mostrarCatalogoSkinCare() {
        $productosSkinCare = DB::table('producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->where('producto.categoria', 'Skincare')
            ->select('producto.*', 'imagen_producto.direccion_imagen')
            ->get();
        
        return view('Skincare', ['productos' => $productosSkinCare]);
    }

    public function mostrarCatalogoCuidadoCapilar() {
        $productosCuidadoCapilar = DB::table('producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->where('producto.categoria', 'Cuidado Capilar')
            ->select('producto.*', 'imagen_producto.direccion_imagen')
            ->get();
        
        return view('CuidadoCapilar', ['productos' => $productosCuidadoCapilar]);
    }

    public function mostrarCatalogoFragancia() {
        $productosFragancia = DB::table('producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->where('producto.categoria', 'Perfume')
            ->select('producto.*', 'imagen_producto.direccion_imagen')
            ->get();
        
        return view('Fragancia', ['productos' => $productosFragancia]);
    }
    public function mostrarDetalleProducto($id) {
        $producto = DB::table('producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->where('producto.id_producto', $id)
            ->select('producto.*', 'imagen_producto.direccion_imagen')
            ->first();
    

        return view('producto', ['producto' => $producto]);
    }
    
    


    
}

