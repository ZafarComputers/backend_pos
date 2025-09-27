<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CountryController
 *
 * Handles web operations for the Country resource.
 * Last updated: 02:35 PM PKT, September 27, 2025.
 */
class CountryController extends Controller
{
    /**
     * Display a listing of all countries.
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $countries = Country::latest()->get();
            return view('countries.index', compact('countries'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to retrieve countries: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new country.
     *
     * @return View
     */
    public function create(): View
    {
        return view('countries.create');
    }

    /**
     * Store a newly created country in storage.
     *
     * Validates the request data and creates a new country record.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:countries,code',
                'currency' => 'required|string|max:10',
                'status' => 'required|boolean',
            ]);

            Country::create($data);

            return redirect()->route('countries.index')->with('success', 'Country created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create country: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified country.
     *
     * @param Country $country
     * @return View
     */
    public function show(Country $country): View
    {
        try {
            return view('countries.show', compact('country'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('countries.index')->withErrors(['error' => 'Country not found']);
        } catch (\Exception $e) {
            return redirect()->route('countries.index')->withErrors(['error' => 'Failed to retrieve country: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param Country $country
     * @return View
     */
    public function edit(Country $country): View
    {
        try {
            return view('countries.edit', compact('country'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('countries.index')->withErrors(['error' => 'Country not found']);
        }
    }

    /**
     * Update the specified country in storage.
     *
     * Validates the request data and updates the country record.
     *
     * @param Request $request
     * @param Country $country
     * @return RedirectResponse
     */
    public function update(Request $request, Country $country): RedirectResponse
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:countries,code,' . $country->id,
                'currency' => 'required|string|max:10',
                'status' => 'required|boolean',
            ]);

            $country->update($data);

            return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('countries.index')->withErrors(['error' => 'Country not found']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update country: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified country from storage.
     *
     * @param Country $country
     * @return RedirectResponse
     */
    public function destroy(Country $country): RedirectResponse
    {
        try {
            $country->delete();
            return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('countries.index')->withErrors(['error' => 'Country not found']);
        } catch (\Exception $e) {
            return redirect()->route('countries.index')->withErrors(['error' => 'Failed to delete country: ' . $e->getMessage()]);
        }
    }
}