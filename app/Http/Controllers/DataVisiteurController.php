<?php

namespace App\Http\Controllers;

use App\Models\DataVisiteur;
use App\Http\Requests\StoreDataVisiteurRequest;
use App\Http\Requests\StoreVisiteRequest;
use App\Http\Requests\UpdateDataVisiteurRequest;
use App\Models\Visiteur;
use App\Repositories\DataVisiteurRepository;
use Illuminate\Http\RedirectResponse;
use Flash;


class DataVisiteurController extends Controller
{

    private $dataVisiteurRepository;

    public function __construct(DataVisiteurRepository $dataRepo)
    {
        $this->dataVisiteurRepository = $dataRepo;
    }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
        
    //     return \view('visiteurs.total_visite');
    // }


    // public function create(Visiteur $visite)
    // {
    //     $visite = Visiteur::all();
    //     return view('visiteurs.create_visite', compact('visite'));
    // }

    public function index(): \Illuminate\View\View
    {
        $data = $this->dataVisiteurRepository->getData();
        return view('visiteurs.create_visite', compact('data'));
    }


    public function store(StoreDataVisiteurRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->dataVisiteurRepository->store($input);
        Flash::success(__('messages.flash.visite_create'));
        return redirect(route('assistants.historiques-visites.index'));
    }







    // public function store(StoreDataVisiteurRequest $request)
    // {
    //     // Essayons une autre maniere d'écrire notre fonction d'envoie des données avec cette ecriture, chaque name du formulaire doit etre identique avec les colonnes de notre table
    //     // - mettre (protected) dans le model 

    //     $query = Visiteur::create($request->all());
    //     if ($query) {
    //         return redirect()->route('store-visite')->with('success_message', 'Employé ajouter avec succès'); //success_message sera affiche sur la page ou je serai rediriger. mais sur la page en question je dois mette le code d'affichage de session
    //     }
    // }










    // public function show(Visiteur $visite)
    // {
    //     $visiteurDetailData = $this->visiteurRepo->visiteurDetail($visiteur);
    //     return view('visiteurs.create_visite', compact('visite', 'visiteurDetailData'));
    // }




    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    //     return \view('visiteurs.create_visite');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreDataVisiteurRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(DataVisiteur $dataVisiteur)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataVisiteur $dataVisiteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataVisiteurRequest $request, DataVisiteur $dataVisiteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataVisiteur $dataVisiteur)
    {
        //
    }
}
