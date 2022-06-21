<?php

namespace App\Http\Services;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;

class CountryService
{
    public const URL = 'https://restcountries.com/v3.1/region/europe';

    /**
     * @return void
     */
    public function save(): void
    {
        $response = Http::withOptions([
            'verify' => false // Just in development
        ])->get(self::URL);

        if ($response->ok()) {
            foreach ($response->object() as $item) {
                Country::updateOrCreate(
                    ['name' => $item->name->common],
                    ['capital' => $item->capital[0]]
                );
            }
        }
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        return CountryResource::collection(Country::all());
    }

    /**
     * @param Country $country
     * @return CountryResource
     */
    public function get(Country $country): CountryResource
    {
        return new CountryResource($country);
    }

    /**
     * @param Request $request
     * @param Country $country
     * @return CountryResource
     */
    public function update(Request $request, Country $country): CountryResource
    {
        $country->update($request->all());
        return new CountryResource($country);
    }
}
