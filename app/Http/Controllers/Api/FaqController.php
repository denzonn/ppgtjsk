<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends BaseController
{
    public function index()
    {
        $faq = faq::all();

        return $this->sendResponse($faq, 'Success get all FAQ');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        if($validation->fails()){
            return $this->sendError('Validation eror', $validation->errors(), 400);
        }
        
        $faq = faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return $this->sendResponse($faq, 'Success create FAQ');
    }

    public function edit($id)
    {
        $faq = faq::findOrFail($id);

        return $this->sendResponse($faq, 'Success get FAQ data');
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        if($validation->fails()){
            return $this->sendError('Validation eror', $validation->errors(), 400);
        }

        $faq = faq::findOrFail($id);
        
        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);
        
        return $this->sendResponse($faq, 'Success update FAQ');

    }

    public function destroy($id)
    {
        $faq = faq::findOrFail($id);

        $faq->delete();

        return $this->sendResponse($faq, 'Success delete FAQ');
    }
}
