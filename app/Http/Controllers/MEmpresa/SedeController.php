<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:02 AM
 */

namespace Ecotickets\Http\Controllers\MEmpresa;


use Eco\Negocio\Logica\SedeServicio;
use Eco\Validaciones\SedeValidaciones;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class SedeController extends Controller
{
    protected  $sedeServicio;
    protected  $sedeValidaciones;

    public function __construct(SedeServicio $sedeServicio,SedeValidaciones $sedeValidaciones){
        $this->middleware('auth');
        $this->sedeServicio = $sedeServicio;
        $this->sedeValidaciones = $sedeValidaciones;
    }

    //Metodo para cargar  la vista de crear sede
    public function CrearSede(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $view = View::make('MEmpresa/crearSede');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/crearSede');
    }

    //Metodo para cargar  la vista de editar sede
    public function EditarSede(Request $request, $idSede)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idSede,$urlinfo)[0];//se parte la url para quitarle el parametro y porder consultarla NOTA:provicional mientras se encuentra otra forma
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $sede = $this->sedeServicio->ObtenerSede($idSede);
        $view = View::make('MEmpresa/editarSede',array('sede'=>$sede));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/editarSede');
    }



    //Metodo para guarda la sede
    public  function GuardarSede(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->sedeValidaciones->ValidarFormularioCrear($request->all())->validate();
        $sede = $request->all();
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $sede['Empresa_id'] = $idEmpreesa;
        $repuesta = $this->sedeServicio->GuardarSede($sede);
        $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        if($request->ajax()){
            if($repuesta == true){
                $view = View::make('MEmpresa/listaSedes')->with('listSedes',$sedes);
                $sections = $view->renderSections();
                return Response::json($sections['content']);
            }
        }else return view('MEmpresa/listaSedes',['listSedes'=>$sedes]);
    }

    //Metodo para obtener toda  la lista de sede de la empresa
    public  function ObtenerSedes(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('MEmpresa/listaSedes')->with('listSedes',$sedes);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MEmpresa/listaSedes',['listSedes'=>$sedes]);
    }
}