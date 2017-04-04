<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Load sample data, an array of associative arrays. */
require(app_path() . '/pms.php');

// Display search form
Route::get('/', function()
{
	return View::make('pms.query');
});

// Perform search and display results
Route::get('search', function()
{
    $input = request()->all(); // gets all input as an associative array
    $name = $input['name'];
    $year = $input['year'];
    $state = $input['state'];

    $results = search($name, $year, $state);

    return View::make('pms.results')->withPms($results);
});


/* Functions for PM database example. */

/* Search sample data for $name or $year or $state from form. */
function search($name, $year, $state) {
  $pms = getPms();

  // Filter $pms by $name
  if (!empty($name)) {
    $results = array();
    foreach ($pms as $pm) {
      if (stripos($pm['name'], $name) !== FALSE) {
        $results[] = $pm;
      }
    }
    $pms = $results;
  }

  // Filter $pms by $year
  if (!empty($year)) {
    $results = array();
    foreach ($pms as $pm) {
      if (strpos($pm['from'], $year) !== FALSE || 
          strpos($pm['to'], $year) !== FALSE) {
        $results[] = $pm;
      }
    }
    $pms = $results;
  }

  // Filter $pms by $state
  if (!empty($state)) {
    $results = array();
    foreach ($pms as $pm) {
      if (stripos($pm['state'], $state) !== FALSE) {
        $results[] = $pm;
      }
    }
    $pms = $results;
  }

  return $pms;
}