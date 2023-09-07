<?php

namespace App\Http\Controllers\API;

use App\Models\Sekolah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class SekolahController extends BaseController
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
            'sekolah' => 'required',
            // 'tenant' => 'required',
        ]);

        foreach ($input as $key => $value) {
            // $data[$key] = $value;
            $save = Sekolah::updateOrCreate([
                'npsn' => $value['npsn'],
            ], $value);
            // return $this->sendResponse($save, 'Product created successfully.');
            // $tenant = Filament::getTenant();
            // $tenant->sekolahs->attach($save);

            // $team->users()->attach(auth()->user());

        }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $sekolah = Sekolah::create($input);

        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        return $this->sendResponse($save, 'Sinkronisasi Sekolah Berhasil');
    }
}
