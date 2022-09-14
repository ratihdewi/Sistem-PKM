<?php

namespace App\Http\Controllers\Proposal;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class EditProposalController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $document = Document::find($id);

        $validator = Validator::make($request->all(), [
            'skema_pkm_id' => 'required',
            'title' => 'required',
            'pendanaan_dikti' => 'required',
            'pendanaan_pt' => 'required',
            'proposal' => 'nullable|mimes:docx,pdf'
        ]);

        if ($document) {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create report',
                    'error' => $validator->errors(),
                ], 400);
            }

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

            $validated = $validator->validated();
            $validated['file'] = json_encode($file);

            $proposal = $document->fill($validated);
            $proposal->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Update proposal successfully',
                'data' => $proposal,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Id not found',
                'data' => null,
            ], 404);
        }
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
