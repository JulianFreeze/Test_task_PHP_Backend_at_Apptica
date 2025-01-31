## Starting

Project was created with Open Server Panel v 6.0.0. Folder **/.osp** is required for it.

- PHP 8.3
- MySQL-8.0
- Laravel Framework 11.41.0

To prepare DB structure run: `php artisan migrate`

Main page is https://laravel-api.local/

## Getting and storing data

Main page title *"No data is avaliable."* means DataBase is empty.
To fill/refresh DB tables with data from *Apptica API* use link [*"Refresh table data"*](https://laravel-api.local/refresh) on main page.
Data is requested for the past 30 days.

Main page title *"Data is avaliable"* means DataBase is filled.

## API endpoints

### **GET** - ../api/appTopCategory

| Param | Description                    |
| ----- | ------------------------------ |
| date  | *required* Date, format Y-m-d  |

Logs are stored in `./storage/logs/api.log`