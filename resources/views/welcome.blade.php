<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div>
            <p>
                {{$state}}
            </P>
        </div>
        <a href={{$refreshUrl}}>Refresh table data</a>
    </body>
</html>
