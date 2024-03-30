<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @spladeHead
        @vite('resources/js/app.js')
        <style>
            .md-editor-preview {
                word-break: unset !important;
            }
        </style>
    </head>
    <body class="font-main antialiased dark bg-white">
        @splade
    </body>
</html>
