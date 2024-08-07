<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder;

class ChirpController extends Controller
{
	/**
	* Display a listing of the resource.
	*/
	public function index(): View
	{
		return view('chirps.index', [
		'chirps' => Chirp::with('user')->latest()->get(),
		 ]);
	}

	/**
	* Show the form for creating a new resource.
	*/
	public function create()
	{
		//
	}

	/**
	* Store a newly created resource in storage.
	*/
	public function store(Request $request): RedirectResponse
	{
		$validated = $request->validate([
			'message' => 'required|string|max:255',
		]);

		$request->user()->chirps()->create($validated);

		return redirect(route('chirps.index'));
	}

	/**
	* Display the specified resource.
	*/
	public function show(Chirp $chirp)
	{
		//
	}

	/**
	* Show the form for editing the specified resource.
	*/
	public function edit(Chirp $chirp): View
	{
		Gate::authorize('update', $chirp);

		return view('chirps.edit', [
			'chirp' => $chirp,
		]);
	}

	/**
	* Update the specified resource in storage.
	*/
	public function update(Request $request, Chirp $chirp): RedirectResponse
	{
		Gate::authorize('update', $chirp);

		$curId = $chirp->id;
		
		$validator = $request->validate(
			[
				'message' => 'required|string|max:255|unique:chirps,message,NULL,id,id,'.$curId.'',
			],
			[
				'message.unique' => "You haven't changed the chirp in the edit!",
				'message.required' => "You can't send out an empty chirp!",
				'message.max' => "That chirp is too long! Chirps must be under 255 characters, because.. uhhh.. because we said so.",
			]
		);
		
		$changeVerification = $chirp->update($validator);

		return redirect(route('chirps.index'))->with('updateVerification',$changeVerification);
	}

	/**
	* Remove the specified resource from storage.
	*/
	public function destroy(Chirp $chirp)
	{
		//
	}
}
