<?php

class RankingsController extends \BaseController {

	/**
	 * Display a listing of rankings
	 *
	 * @return Response
	 */
	public function index()
	{
		$rankings = Ranking::all();

		return View::make('rankings.index', compact('rankings'));
	}

	/**
	 * Show the form for creating a new ranking
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('rankings.create');
	}

	/**
	 * Store a newly created ranking in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Ranking::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Ranking::create($data);

		return Redirect::route('rankings.index');
	}

	/**
	 * Display the specified ranking.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ranking = Ranking::findOrFail($id);

		return View::make('rankings.show', compact('ranking'));
	}

	/**
	 * Show the form for editing the specified ranking.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ranking = Ranking::find($id);

		return View::make('rankings.edit', compact('ranking'));
	}

	/**
	 * Update the specified ranking in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ranking = Ranking::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Ranking::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ranking->update($data);

		return Redirect::route('rankings.index');
	}

	/**
	 * Remove the specified ranking from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Ranking::destroy($id);

		return Redirect::route('rankings.index');
	}

}
