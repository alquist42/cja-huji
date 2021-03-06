<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- API Token -->
    <meta name="api-token" content="{{ Auth::user()->api_token }}">

    <title>{{ isset($header['title']) ? "{$header['title']} | The Center of Jewish Art" : 'The Center of Jewish Art' }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel=stylesheet href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel=stylesheet href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
    <link href="{{ vuecli('chunk-vendors.css') }}" rel=stylesheet>
    <link href="{{ vuecli('app.css') }}" rel=stylesheet>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/MediaManager/style.css') }}"/>
    <link rel="icon" href="http://cja.huji.ac.il/favicon.ico" type="image/x-icon" />

    <!-- Scripts -->
    <script>

    </script>
</head>
<body>

<div
    id="laravel-media-manager"
    v-cloak
>
    <v-dialog v-model="mediaManagerDialog">
        <media-manager-modal
                inline-template
                :item-id="itemId"
        >
            <div>
                <metadata-editor-drawer></metadata-editor-drawer>

                <div v-if="inputName">@include('MediaManager::extras.modal')</div>

                <media-modal item="images" :name="inputName" :multi="true"></media-modal>

                <input type="hidden" name="images" :value="images" />
            </div>
        </media-manager-modal>
    </v-dialog>
    <template v-if="mediaManager">
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <div class="container is-fluid">
            <div class="columns">
                <div class="column">
                    @include('MediaManager::_manager')
                </div>
            </div>
        </div>
    </template>
</div>

<!-- Scripts -->

<div id="app"></div>

<script src="{{ vuecli('chunk-vendors.js') }}"></script>
<script src="{{ vuecli('app.js') }}"></script>

</body>

</html>
