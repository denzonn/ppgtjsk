<?php

namespace App\Http\Controllers;

use App\Models\Dokument;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documen = Dokument::all();

        return view('pages.document', [
            'documen' => $documen
        ]);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $documents = Dokument::where('judul', 'LIKE', '%' . $searchQuery . '%')->get();

        return view('pages.document-search', [
            'documents' => $documents,
            'searchQuery' => $searchQuery
        ]);
    }
}
