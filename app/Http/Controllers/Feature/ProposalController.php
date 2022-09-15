<?php

namespace App\Http\Controllers\Feature;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\PKM\JenisPKM;
use App\Models\PKM\SkemaPKM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProposalController extends Controller
{
    public function index()
    {
        return view('page.proposal.index');
    }

    public function create()
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.proposal.create', compact('jenis_pkm'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skema_pkm' => 'required',
            'title' => 'required',
            'pendanaan_dikti' => 'required',
            'pendanaan_pt' => 'required',
            'luaran_proposal' => 'required',
            'proposal' => 'nullable|mimes:docx,pdf'
        ]);

        $proposal_name = null;
        $file = [];

        if ($request->has('proposal')) {
            $file_proposal = $request->proposal;
            $file_name = Carbon::now()->timestamp . '-' . $file_proposal->getClientOriginalName();
            $this->upload($file_name, $file_proposal, 'documents');
            $proposal_name = $file_name;
        }

        $file = [
            'luaran_proposal' => $request->luaran_proposal,
            'proposal' => $proposal_name
        ];

        $validated['skema_pkm_id'] = $request->skema_pkm;
        $validated['file'] = json_encode($file);

        Document::create($validated);

        return redirect(route('proposal.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'skema_pkm' => 'required',
            'title' => 'required',
            'pendanaan_dikti' => 'required',
            'pendanaan_pt' => 'required',
            'luaran_proposal' => 'required',
            'proposal' => 'nullable|mimes:docx,pdf'
        ]);

        $proposal_name = null;
        $file = [];

        if ($request->has('proposal')) {
            $file_proposal = $request->proposal;
            $file_name = Carbon::now()->timestamp . '-' . $file_proposal->getClientOriginalName();
            $this->upload($file_name, $file_proposal, 'documents');
            $proposal_name = $file_name;

            $document_data = json_decode($document->file);
            unlink(public_path("documents/{$document_data->proposal}"));
        }

        $file = [
            'luaran_proposal' => $request->luaran_proposal,
            'proposal' => $proposal_name
        ];

        $validated['skema_pkm_id'] = $request->skema_pkm;
        $validated['file'] = json_encode($file);

        $document->fill($validated);
        $document->save();

        return redirect(route('proposal.index'));
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return redirect(route('proposal.index'));
    }

    public function skema_pkm($parent_id)
    {
        $skema_pkm = SkemaPKM::where('jenis_pkm_id', $parent_id)->orderBy('id', 'asc')->get();

        return $skema_pkm;
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
