<?php

namespace App\Http\Controllers;
use App\Models\Record;
use App\Models\RecordSupport;
use App\Models\RecordStatus;
use App\Models\Container;
use App\Models\ContainerStatus;
use App\Models\Activity;
use App\Models\Term;
use App\Models\Accession;
use App\Models\Author;
use App\Models\RecordLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Level;


class RecordController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $records = Record::where('name', 'LIKE', "%$query%")
                        ->orWhere('code', 'LIKE', "%$query%")
                        ->orWhere('date_start', 'LIKE', "%$query%")
                        ->orWhere('date_end', 'LIKE', "%$query%")
                        ->orWhere('date_exact', 'LIKE', "%$query%")
                        ->orWhere('biographical_history', 'LIKE', "%$query%")
                        ->orWhere('archival_history', 'LIKE', "%$query%")
                        ->orWhere('acquisition_source', 'LIKE', "%$query%")
                        ->orWhere('content', 'LIKE', "%$query%")
                        ->orWhere('appraisal', 'LIKE', "%$query%")
                        ->orWhere('accrual', 'LIKE', "%$query%")
                        ->orWhere('arrangement', 'LIKE', "%$query%")
                        ->orWhere('access_conditions', 'LIKE', "%$query%")
                        ->orWhere('reproduction_conditions', 'LIKE', "%$query%")
                        ->orWhere('language_material', 'LIKE', "%$query%")
                        ->orWhere('characteristic', 'LIKE', "%$query%")
                        ->orWhere('finding_aids', 'LIKE', "%$query%")
                        ->orWhere('location_original', 'LIKE', "%$query%")
                        ->orWhere('location_copy', 'LIKE', "%$query%")
                        ->orWhere('related_unit', 'LIKE', "%$query%")
                        ->orWhere('publication_note', 'LIKE', "%$query%")
                        ->orWhere('note', 'LIKE', "%$query%")
                        ->orWhere('archivist_note', 'LIKE', "%$query%")
                        ->orWhere('rule_convention', 'LIKE', "%$query%")
                        ->get();
        dd($records);
        return view('records.index', compact('records'));
    }



    public function index()
    {
        $records = Record::all();

        return view('records.index', compact('records'));
    }


    public function create()
    {
        $statuses = RecordStatus::all();
        $supports = RecordSupport::all();
        $activities = Activity::all();
        $parents = Record::all();
        $containers = Container::all();
        $accessions = Accession::all();
        $users = User::all();
        $levels = RecordLevel::all();
        $records = Record::all();
        $authors = Author::with('authorType')->get();
        $terms = Term::all();
        return view('records.create', compact('records','terms','authors','levels','statuses', 'supports', 'activities', 'parents', 'containers', 'accessions', 'users'));
    }


    public function store(Request $request)
    {
        // Définissez une valeur par défaut pour date_format
        $request->merge(['date_format' => $request->input('date_format', 'Y')]);
        $request->merge(['user_id' => Auth::id()]);
//         dd($request);
        $validatedData = $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string',
            'date_format' => 'required|string|max:1',
            'date_start' => 'nullable|string|max:10',
            'date_end' => 'nullable|string|max:10',
            'date_exact' => 'nullable|date',
            'level_id' => 'required|integer|exists:record_levels,id',
            'width' => 'nullable|numeric|between:0,99999999.99',
            'width_description' => 'nullable|string|max:100',
            'biographical_history' => 'nullable|string',
            'archival_history' => 'nullable|string',
            'acquisition_source' => 'nullable|string',
            'content' => 'nullable|string',
            'appraisal' => 'nullable|string',
            'accrual' => 'nullable|string',
            'arrangement' => 'nullable|string',
            'access_conditions' => 'nullable|string|max:50',
            'reproduction_conditions' => 'nullable|string|max:50',
            'language_material' => 'nullable|string|max:50',
            'characteristic' => 'nullable|string|max:100',
            'finding_aids' => 'nullable|string|max:100',
            'location_original' => 'nullable|string|max:100',
            'location_copy' => 'nullable|string|max:100',
            'related_unit' => 'nullable|string|max:100',
            'publication_note' => 'nullable|string',
            'note' => 'nullable|string',
            'archivist_note' => 'nullable|string',
            'rule_convention' => 'nullable|string|max:100',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'status_id' => 'required|integer|exists:record_statuses,id',
            'support_id' => 'required|integer|exists:record_supports,id',
            'activity_id' => 'required|integer|exists:activities,id',
            'parent_id' => 'nullable|integer|exists:records,id',
            'container_id' => 'nullable|integer|exists:containers,id',
            'accession_id' => 'nullable|integer|exists:accessions,id',
            'user_id' => 'required|integer|exists:users,id',
            'author_ids' => 'required|array',
            'term_ids' => 'required|array',
        ]);

        // Créez le record
        $record = Record::create($validatedData);

        // Supprimez les clés author_ids et term_ids du tableau $validatedData
        $term_ids = $request->input('term_ids');
        $author_ids = $request->input('author_ids');
        $term_ids = explode(',', $term_ids[0]);

        $author_ids = explode(',', $author_ids[0]);
// Supprimez les valeurs vides du tableau
//        $term_ids = array_filter($term_ids);
//        $author_ids = array_filter($author_ids);

// Convertissez les valeurs en entiers
        $term_ids = array_map('intval', $term_ids);
        $author_ids = array_map('intval', $author_ids);
//        // Attachez les auteurs au record
//        dd($author_ids,$term_ids);

        foreach ($author_ids as $author_id) {
            $record->authors()->attach($author_id);
        }

        // Attachez les termes au record
        foreach ($term_ids as $term_id) {
            $record->terms()->attach($term_id);
        }

        return redirect()->route('records.index')->with('success', 'Record created successfully.');
    }

    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }


    public function edit(Record $record)
    {
        $statuses = RecordStatus::all();
        $supports = RecordSupport::all();
        $activities = Activity::all();
        $parents = Record::all();
        $containers = Container::all();
        $accessions = Accession::all();
        $users = User::all();
        $levels = RecordLevel::all();
        return view('records.edit', compact('levels','record', 'statuses', 'supports', 'activities', 'parents', 'containers', 'accessions', 'users'));
    }


    public function update(Request $request, Record $record)
    {
        $validatedData = $request->validate([
            'code' => 'nullable|string|max:10',
            'name' => 'nullable|string',
            'date_format' => 'nullable|string|max:1',
            'date_start' => 'nullable|string|max:10',
            'date_end' => 'nullable|string|max:10',
            'date_exact' => 'nullable|date',
            'level_id' => 'required|integer|exists:record_levels,id',
            'width' => 'nullable|numeric|between:0,99999999.99',
            'width_description' => 'nullable|string|max:100',
            'biographical_history' => 'nullable|string',
            'archival_history' => 'nullable|string',
            'acquisition_source' => 'nullable|string',
            'content' => 'nullable|string',
            'appraisal' => 'nullable|string',
            'accrual' => 'nullable|string',
            'arrangement' => 'nullable|string',
            'access_conditions' => 'nullable|string|max:50',
            'reproduction_conditions' => 'nullable|string|max:50',
            'language_material' => 'nullable|string|max:50',
            'characteristic' => 'nullable|string|max:100',
            'finding_aids' => 'nullable|string|max:100',
            'location_original' => 'nullable|string|max:100',
            'location_copy' => 'nullable|string|max:100',
            'related_unit' => 'nullable|string|max:100',
            'publication_note' => 'nullable|string',
            'note' => 'nullable|string',
            'archivist_note' => 'nullable|string',
            'rule_convention' => 'nullable|string|max:100',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'status_id' => 'required|integer|exists:record_status,id',
            'support_id' => 'required|integer|exists:record_supports,id',
            'activity_id' => 'required|integer|exists:activities,id',
            'parent_id' => 'nullable|integer|exists:records,id',
            'container_id' => 'nullable|integer|exists:containers,id',
            'accession_id' => 'nullable|integer|exists:accessions,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $record->update($validatedData);

        return redirect()->route('records.index')->with('success', 'Record updated successfully.');
    }


    public function destroy(Record $record)
    {
        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
