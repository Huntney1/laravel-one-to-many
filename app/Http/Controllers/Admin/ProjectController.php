<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller; // Classe da non dimenticare
use App\Models\Project;
use DateTime;


class ProjectController extends Controller
{

    //! -INDEX-
    /**
     * Display a listing of the resource.
     ** Mostra l'elenco dei progetti.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //* Utilizzo del metodo paginate e del metodo with per caricare i dati correlati
        //* e ottenere un numero limitato dei record alla volta
        //! $projects = Project::with('category')->paginate(10);

        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    //! -CREATE-
    /**
     * Show the form for creating a new resource.
     ** Mostra il form e il metodo per creare un nuovo progetto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    //! -STORE-
    /**
     * Store a newly created resource in storage.
     ** Salva il nuovo progetto nel Database.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title);

        //*Aggiungo Coppia Chiave Valore All'array $form_data
        $form_data['slug'] = $slug;

        $newProject = new Project;

        //* Converti la data nel formato desiderato
        if (!empty($form_data['published'])) {
            $date = new DateTime($form_data['published']);
            $form_data['published'] = $date->format('d-m-Y');
            unset($form_data['published']);

            $newProject->fill($form_data);
            $newProject->save();

            return redirect()->route('admin.projects.index')->with('message', 'Progetto Creato con successo.');
        }

    }

    //! -SHOW-
    /**
     * Display the specified resource.
     ** Visualizza la risorsa specificata.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    //! -EDIT-
    /**
     * Show the form for editing the specified resource.
     ** Vsualizza il modulo per la modifica della risorsa specificata.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    //! -UPDATE-
    /**
     * Update the specified resource in storage.
     ** Aggiorna la risorsa specificata nell'archiviazione.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title, '-');
        $form_data['slug'] = $slug;

       $project->update($form_data);
        return redirect()->route('admin.projects.index')->with('message', $project->title. 'Progetto Modificato Correttamente');
    }

    //! -DESTROY-
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Progetto Eliminato con Successo.');
    }
}
