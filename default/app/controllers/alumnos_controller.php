<?php
class AlumnosController extends AppController
{
    public function index($pages = 1)
    {
     View::template('pantalla');
     $this->titulo = "Listado Alumnos";
     $this->listAlumnos = (new Alumnos)->getAlumnos($pages);
    }

    public function contactos()
    {
        $this->titulo = "Listado de Contactos";
        View::template('pantalla');
    }

    public function create(){
        View::template('pantalla');
        if(Input::hasPost('alumnos')){
            $alumno = new Alumnos(Input::post('alumnos'));
            if(!$alumno->save()){
                Flash::error("Error al guardar el alumno");
            }else{
                Flash::valid("Alumno guardado correctamente");
                Input::delete();
            }
        }
    }

    public function edit($id){
        View::template('pantalla');
        $alumno = new Alumnos();
        if(Input::hasPost('alumnos')){
            if(!$alumno->update(Input::post('alumnos'))){
                Flash::error("Error al actualizar el alumno");
            }else{
                Flash::valid("Alumno actualizado con exito");
                return Redirect::to();
            }
        }else{
            $this->alumnos = $alumno->find((int) $id);
        }
    }

    public function del($id){
        $alumno = new Alumnos();
        if(!$alumno->delete((int) $id)){
            Flash::error("Error al borrar el estudiante");
        }else{
            Flash::valid("Alumno Borrado de forma satisfactoria");
        }
        return Redirect::to();
    }
}
