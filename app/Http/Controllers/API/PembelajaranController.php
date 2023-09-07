<?php

namespace App\Http\Controllers\API;

use App\Models\Pembelajaran;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class PembelajaranController extends BaseController
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
        // return $this->sendResponse($input['pembelajaran'], 'Sinkronisasi Sekolah Berhasil');

        $validator = Validator::make($input, [
            'pembelajaran' => 'required',
            // 'detail' => 'required',
        ]);

        foreach ($input['pembelajaran'] as $key => $value) {

            // $data[] = $value['rombongan_belajar_id'];
            foreach ($value['pembelajaran'] as $key => $value2) {
                $save = Pembelajaran::updateOrCreate([
                    'pembelajaran_id' => $value2['pembelajaran_id'],
                ], $value2);
                Team::find($input['tenant']['id'])->pembelajarans()->syncWithoutDetaching($save['id']);
                $save->update(
                    [
                        'rombongan_belajar_id' => $value['rombongan_belajar_id'],
                    ]);

            }

            // return $this->sendResponse($save, 'Sinkronisasi Sekolah Berhasil');
        }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $sekolah = Sekolah::create($input);

        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        return $this->sendResponse($save, 'Sinkronisasi Rombongan Belajar Berhasil');
    }
}
