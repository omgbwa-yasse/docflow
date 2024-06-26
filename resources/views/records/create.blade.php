@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Description </h1>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="identification-tab" data-toggle="tab" href="#identification" role="tab" aria-controls="identification" aria-selected="true">Identification</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contexte-tab" data-toggle="tab" href="#contexte" role="tab" aria-controls="contexte" aria-selected="false">Contexte</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contenu-tab" data-toggle="tab" href="#contenu" role="tab" aria-controls="contenu" aria-selected="false">Contenu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="condition-tab" data-toggle="tab" href="#condition" role="tab" aria-controls="condition" aria-selected="false">Condition d'accès</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sources-tab" data-toggle="tab" href="#sources" role="tab" aria-controls="sources" aria-selected="false">Sources complémentaires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="controle-tab" data-toggle="tab" href="#controle" role="tab" aria-controls="controle" aria-selected="false">Contrôle de description</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="indexation-tab" data-toggle="tab" href="#indexation" role="tab" aria-controls="indexation" aria-selected="false">Indexation</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="identification" role="tabpanel" aria-labelledby="identification-tab">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="level_id" class="form-label">Level</label>
                            <select name="level_id" id="level_id" class="form-select" required>
                                <option value="">Select Level</option>
                                @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="support_id" class="form-label">Support</label>
                            <select name="support_id" id="support_id" class="form-select" required>
                                <option value="">Select Support</option>
                                @foreach ($supports as $support)
                                <option value="{{ $support->id }}">{{ $support->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" name="code" id="code" class="form-control" required maxlength="10">
                        </div>
                    </div>
                    <div class="mb-3">

                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <textarea name="name" id="name" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="date_start" class="form-label">Date Start</label>
                            <input type="text" name="date_start" id="date_start" class="form-control" maxlength="10">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_end" class="form-label">Date End</label>
                            <input type="text" name="date_end" id="date_end" class="form-control" maxlength="10">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_exact" class="form-label">Date Exact</label>
                            <input type="date" name="date_exact" id="date_exact" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="width" class="form-label">Width</label>
                            <input type="number" name="width" id="width" class="form-control" step="0.01" min="0" max="9999999999.99">
                        </div>
                        <div class="col-md-10 mb-3">
                            <label for="width_description" class="form-label">Width Description</label>
                            <input type="text" name="width_description" id="width_description" class="form-control" maxlength="100">
                        </div>
                    </div>
                </div>
        <div class="tab-pane fade" id="contexte" role="tabpanel" aria-labelledby="contexte-tab">

                    <div class="mb-3">
                        <label for="level_id[]" class="form-label">Producteur </label>
                        <select name="author_id[]" id="level_id[]" class="form-select">
                            <option value=""></option>
                            @foreach ($levels as $level)
                            <option value=""></option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-outline-primary" >
                            Créer un producteur
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="biographical_history" class="form-label">Biographical History</label>
                        <textarea name="biographical_history" id="biographical_history" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="archival_history" class="form-label">Archival History</label>
                        <textarea name="archival_history" id="archival_history" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="acquisition_source" class="form-label">Acquisition Source</label>
                        <textarea name="acquisition_source" id="acquisition_source" class="form-control"></textarea>
                    </div>

        </div>
        <div class="tab-pane fade" id="contenu" role="tabpanel" aria-labelledby="contenu-tab">
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="appraisal" class="form-label">Appraisal</label>
                <textarea name="appraisal" id="appraisal" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="accrual" class="form-label">Accrual</label>
                <textarea name="accrual" id="accrual" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="arrangement" class="form-label">Arrangement</label>
                <textarea name="arrangement" id="arrangement" class="form-control"></textarea>
            </div>
        </div>
        <div class="tab-pane fade" id="condition" role="tabpanel" aria-labelledby="condition-tab">
            <div class="mb-3">
                <label for="access_conditions" class="form-label">Access Conditions</label>
                <input type="text" name="access_conditions" id="access_conditions" class="form-control" maxlength="50">
            </div>
            <div class="mb-3">
                <label for="reproduction_conditions" class="form-label">Reproduction Conditions</label>
                <input type="text" name="reproduction_conditions" id="reproduction_conditions" class="form-control" maxlength="50">
            </div>
            <div class="mb-3">
                <label for="language_material" class="form-label">Language Material</label>
                <input type="text" name="language_material" id="language_material" class="form-control" maxlength="50">
            </div>
            <div class="mb-3">
                <label for="characteristic" class="form-label">Characteristic</label>
                <input type="text" name="characteristic" id="characteristic" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="finding_aids" class="form-label">Finding Aids</label>
                <input type="text" name="finding_aids" id="finding_aids" class="form-control" maxlength="100">
            </div>
        </div>
        <div class="tab-pane fade" id="sources" role="tabpanel" aria-labelledby="sources-tab">
            <div class="mb-3">
                <label for="location_original" class="form-label">Location Original</label>
                <input type="text" name="location_original" id="location_original" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="location_copy" class="form-label">Location Copy</label>
                <input type="text" name="location_copy" id="location_copy" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="related_unit" class="form-label">Related Unit</label>
                <input type="text" name="related_unit" id="related_unit" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="publication_note" class="form-label">Publication Note</label>
                <textarea name="publication_note" id="publication_note" class="form-control"></textarea>
            </div>
        </div>
        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea name="note" id="note" class="form-control"></textarea>
            </div>
        </div>
        <div class="tab-pane fade" id="controle" role="tabpanel" aria-labelledby="controle-tab">
            <div class="mb-3">
                <label for="archivist_note" class="form-label">Archivist Note</label>
                <textarea name="archivist_note" id="archivist_note" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="rule_convention" class="form-label">Rule Convention</label>
                <input type="text" name="rule_convention" id="rule_convention" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" id="status_id" class="form-select" required>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="tab-pane fade" id="indexation" role="tabpanel" aria-labelledby="indexation-tab">

            <div class="mb-3">
                <label for="status_id" class="form-label">Thésaurus</label>
                <select name="status_id" id="status_id" class="form-select" required>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-primary" >
                    Ajouter un terme
                </button>
            </div>

            <div class="mb-3">
                <label for="activity_id" class="form-label">Activity</label>
                <select name="activity_id" id="activity_id" class="form-select" required>
                    <option value="">Select Activity</option>
                    @foreach ($activities as $activity)
                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</div>

@endsection
