<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Gtk;
use App\Models\Team;
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

        $validator = Validator::make($input, [
            'gtk' => 'required',
            // 'detail' => 'required',
        ]);
        return $this->sendResponse($input['tenant'], 'Sinkronisasi Sekolah Berhasil');

        foreach ($input['gtk'] as $key => $value) {
            $save = Gtk::updateOrCreate([
                'ptk_id' => $value['ptk_id'],
            ], $value);
            Team::find($input['tenant']['id'])->gtks()->syncWithoutDetaching($save['id']);

            // return $this->sendResponse($value, 'Sinkronisasi Sekolah Berhasil');
        }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $sekolah = Sekolah::create($input);

        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        return $this->sendResponse($save, 'Sinkronisasi GTK Berhasil');
    }
}
