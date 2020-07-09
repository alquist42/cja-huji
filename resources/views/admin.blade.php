<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($header['title']) ? "{$header['title']} | The Center of Jewish Art" : 'The Center of Jewish Art' }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel=stylesheet href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel=stylesheet href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
{{--    <link href="{{ vuecli('chunk-79b5ab55.css') }}" rel=prefetch>--}}
{{--    <link href="{{ vuecli('chunk-e6f85250.css') }}"rel=prefetch>--}}
{{--    <link href="{{ vuecli('chunk-79b5ab55.js') }}" rel=prefetch>--}}
{{--    <link href="{{ vuecli('chunk-e6f85250.js') }}" rel=prefetch>--}}
    <link href="{{ vuecli('chunk-vendors.css') }}" rel=preload as=style>
    <link href="{{ vuecli('dash.css') }}" rel=preload as=style>
    <link href="{{ vuecli('chunk-vendors.js') }}" rel=preload as=script>
    <link href="{{ vuecli('dash.js') }}" rel=preload as=script>
    <link href="{{ vuecli('chunk-vendors.css') }}" rel=stylesheet>
    <link href="{{ vuecli('dash.css') }}" rel=stylesheet>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/MediaManager/style.css') }}"/>
    <link rel="icon" href="http://cja.huji.ac.il/favicon.ico" type="image/x-icon" />

    <!-- Scripts -->
    <script>

    </script>
</head>
<body>

<div id="app"
{{--     data-vue-component="{{ $name }}"--}}
{{--     data-vue-props="{{ json_encode($data) }}"--}}
     data-csrf-token="{{ csrf_token() }}"
{{--     data-auth="{{ json_encode(['user' => Auth::user() ? Auth::user()->only('id', 'first_name', 'last_name') : null]) }}"--}}
>
    <component
            is="{{ $name }}"
            v-bind='{!! json_encode($data, JSON_PRETTY_PRINT) !!}'
    >
        <template #media-manager-modal>
            <media-manager-modal inline-template item-id="{{ $data['id'] }}">
                <div>
                    <div v-if="inputName">@include('MediaManager::extras.modal')</div>

                    <media-modal item="images" :name="inputName" :multi="true"></media-modal>

                    <input type="hidden" name="images" :value="images" />
                </div>
            </media-manager-modal>
        </template>
    </component>
</div>

<!-- Scripts -->
<script src="{{ vuecli('chunk-vendors.js') }}"></script>
<script src="{{ vuecli('dash.js') }}"></script>

</body>

</html>
