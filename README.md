## PHP Interview Test

### Import Rentals
```
api/rentals/import
```
Use the `file_name` query parameter to specify the file name, by default we use the existing resource_accommodation.csv file.

### List Rentals
```
api/rentals
```
Get a list of existing rentals, you can filter by `price_min`, `price_max`, `rooms` optionaly .

```
api/rentals/geo/avg-sqm-price
```
Get the average price per square meter filtering by geo search, the `lat`, `lon` and `rad` parameters are required.

### Export Rentals
```
api/rentals/export
```
Use this endpoint to export the rentals to csv or pdf format with optional `export_type` parameter csv as default, you can optionally use all previous fitlers and geo search parameters.
