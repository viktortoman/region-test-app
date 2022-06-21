<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\CountryService;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    private CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function list(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->countryService->list()
        ], Response::HTTP_OK);
    }

    public function get(Country $country): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->countryService->get($country)
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Country $country): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:countries,name,' . $country->id,
            'capital' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()]);
        }

        return response()->json([
            'success' => true,
            'data' => $this->countryService->update($request, $country)
        ], Response::HTTP_OK);
    }
}
