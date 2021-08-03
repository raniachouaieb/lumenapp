<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Worker;

class WorkersController extends Controller
{

    public function createWorker(Request $request){
        $work = new Worker;
        $work->nom= $request->nom;
        $work->prenom= $request->prenom;
        $work->specialite= $request->specialite;
        $work->exp= $request->exp;
        $work->tel = $request->tel;
        $work->salaire= $request->salaire;
        $work->travail = $request->travail;
        $work->desc = $request->desc;
        $work->img = $request->img;
        $work->lieu = $request->lieu;
        $work->save();
        return response()->json($work);
        }

        public function viewWorker($id){
            $workers = Worker::find($id);
            return response()->json($workers);
        }

        public function getAll(){
            $workers = Worker::all();
            return response()->json($workers);
        }

        public function updateWorker(Request $request, $id){
            $work = Worker::find($id);
            $work->nom = $request->input('nom');
            $work->prenom = $request->input('prenom');
            $work->specialite = $request->input('specialite');
            $work->exp = $request->input('exp');
            $work->tel = $request->input('tel');
            $work->salaire = $request->input('salaire');
            $work->travail = $request->input('travail');
            $work->desc = $request->input('desc');
            $work->img = $request->input('img');
            $work->lieu = $request->input('lieu');
            $work->save();
            return response()->json($work);
            }




        

}