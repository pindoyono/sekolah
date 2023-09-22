<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Gtk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class GtkController extends BaseController
{
    //

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        // return $this->sendResponse($input, 'Sinkronisasi Sekolah Berhasil');

        $validator = Validator::make($input, [
            'gtk' => 'required',
            // 'detail' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $save = Gtk::updateOrCreate([
            'ptk_id' => $input['gtk']['ptk_id'],
        ], $input['gtk']);

        // $sekolah = Sekolah::create($input);

        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        return $this->sendResponse($save, 'Sinkronisasi GTK Berhasil');
    }
}
