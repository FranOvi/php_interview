## PHP Interview Test

### Deploy to Heroku
The app was deployed to Heroku, on `https://php-interview-5aaadac6d842.herokuapp.com` [click here](https://php-interview-5aaadac6d842.herokuapp.com) to open it.


### Import Rentals
```
api/rentals/import
```
Use the `file_name` query parameter to specify the file name, by default we use the existing resource_accommodation.csv file.

### List Rentals
```
api/rentals
```
Get a list of existing rentals, you can filter by `price_min`, `price_max`, `rooms` optionally.

* Get All Rentals [/api/rentals](https://php-interview-5aaadac6d842.herokuapp.com/api/rentals)
* Filter by price range [/api/rentals?price_min=950&price_max=1000](https://php-interview-5aaadac6d842.herokuapp.com/api/rentals?price_min=950&price_max=1000)
* Filter by rooms [/api/rentals?rooms=4](https://php-interview-5aaadac6d842.herokuapp.com/api/rentals?rooms=4)

```
api/rentals/geo/avg-sqm-price
```
Get the average price per square meter filtering by geo search, the `lat`, `lon` and `rad` parameters are required.

* Get average price by geo [api/rentals/geo/avg-sqm-price?lat=40.357600&lon=-3.593050&rad=0.3](https://php-interview-5aaadac6d842.herokuapp.com/api/rentals/geo/avg-sqm-price?lat=40.357600&lon=-3.593050&rad=0.3)


### Export Rentals
```
api/rentals/export
```
Use this endpoint to export the rentals to csv or pdf format with optional `export_type` parameter csv as default, you can optionally use all previous fitlers and geo search parameters.
