// Tell the web client to expect a CSV file
header('Content-Type: text/csv');
// Tell the web client to view the CSV file in a seprate program
header('Content-Disposition: attachment; filename="dishes.csv"');