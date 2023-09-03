<?php

namespace App\Http\Controllers\API;

use App\Models\Siswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class SiswaController extends BaseController
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
            'siswa' => 'required',
            // 'detail' => 'required',
        ]);

        foreach ($input['siswa'] as $key => $value) {
            $save = Siswa::updateOrCreate([
                'nisn' => $value['nisn'],
            ], $value);
            // return $this->sendResponse($value, 'Sinkronisasi Sekolah Berhasil');
        }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $sekolah = Sekolah::create($input);

        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        return $this->sendResponse($save, 'Sinkronisasi Siswa Berhasil');
    }
}
