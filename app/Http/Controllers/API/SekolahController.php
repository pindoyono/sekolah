<?php

namespace App\Http\Controllers\API;

use App\Models\Sekolah;
use App\Models\Team;
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

        // $tenant = Filament::getTenant();

        return $this->sendResponse($input, 'Sinkronisasi Sekolah Berhasil');

        $validator = Validator::make($input, [
            'sekolah' => 'required',
            'tenant' => 'required',
        ]);

        // foreach ($input['sekolah'] as $key => $value) {
        // $data[$key] = $value;
        $save = Sekolah::updateOrCreate([
            'npsn' => $input['sekolah']['npsn'],
        ], $input['sekolah']);
        // return $this->sendResponse($save, 'Product created successfully.');
        // $tenant = Filament::getTenant();
        // $tenant->sekolahs->attach($save);

        // $team->users()->attach(auth()->user());
        $team = Team::query()->find($input['tenant']['id'])->sekolahs()->syncWithoutDetaching($save);

        // }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $sekolah = Sekolah::create($input);

        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        return $this->sendResponse($team, 'Sinkronisasi Sekolah Berhasil');
    }
}
