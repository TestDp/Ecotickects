<?php

namespace Ecotickets\Http\Controllers\Tienda;

use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Producto;
use Eco\Negocio\Logica\ProductosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{
    protected $productosServicio;
    public function __construct(ProductosServicio $productosServicio)
    {
        $this->middleware('auth');
        $this->productosServicio = $productosServicio;

    }
    public  function  getFormularioProducto(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        return view('Tienda/CrearProducto');
    }

    public function crearProducto(Request $EdProducto)
    {
        $EdProducto->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        if($this->productosServicio->crearProducto($EdProducto) ){

            if($EdProducto->hasFile('Imagen_Producto')){
                $file = $EdProducto->file('Imagen_Producto');
                $nombre = 'imagenProducto_'.$EdProducto->Nombre_Producto.'.jpg';
                $file->move(public_path().'/imagenesProductos/'.$user->id.'/', $nombre);
            }
            return redirect('/misproductos');
        }else{
            return redirect('/');
        }

    }

    public  function  ObtenerMisProductos(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        $productos=[];
        if(Auth::user()->hasRole('admin'))
        {
            $productos = Producto::all();//lineas de codigo que se deben llevar por capas
        }else{
            $productos = $this->productosServicio->ObtenerMisProductos($user->id);
        }
        $rutaImagenes='imagenesProductos/'.$user->id.'/'; //desde variable de configuracion se debe llamar
        $ListaProductos= array('productos' => $productos,'rutaImagenes'=>$rutaImagenes);
        return view('Tienda/ListaProducto',$ListaProductos);
    }

    public function FormularioActivarProductos(Request $request,$idProducto)
    {
        $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        $eventos=[];
        if(Auth::user()->hasRole('admin'))
        {
            $eventos = Evento::all();//lineas de codigo que se deben llevar por capas
        }else{
            $eventos = $this->productosServicio->ObtenerProductosXeventos($idProducto);
        }
        $producto = $this->productosServicio->ObtenerProducto($idProducto);
        $eventoListaDesplegable = $this->productosServicio->ObtenerListaDesplegable($idProducto,$user->id);
        $ListaEventos= array('eventos' => $eventos,'producto' =>$producto,'eventoLista'=>$eventoListaDesplegable);
        return view('Tienda/ActivarProductoEventos',$ListaEventos);
    }

    public  function  agregarProductoXEventos($idProducto,$idEvento)
    {
        return response()->json($this->productosServicio->agregarProductoXEventos($idProducto,$idEvento));
    }

    public  function  eliminarProductoXEventos($idProducto,$idEvento)
    {
        if($this->productosServicio->eliminarProductoXEventos($idProducto,$idEvento) )
        {
            return redirect('/FormularioActivarProducto/'.$idProducto);
        }else{
            return redirect('/home');
        }
    }

}
