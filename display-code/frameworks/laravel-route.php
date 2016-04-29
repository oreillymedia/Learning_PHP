Route::get('/show', function() {
    $now = new DateTime();
    $items = [ "Fried Potatoes", "Boiled Potatoes", "Baked Potatoes" ];
    return view('show-menu', [ 'when' => $now,
                               'what' => $items ]);
});