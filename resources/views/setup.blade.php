<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Marbles</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!}
        </script>
    </head>
    <body>
        <div id="app">
            <colorsetup v-if="step === 'colorsetup'"></colorsetup>
            <marblesetup v-if="step === 'marblesetup'"></marblesetup>
            <buckets v-if="step === 'buckets'"></buckets>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
