<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ck Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Ck Editor CDN link of stylesheet --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />

    <style>
        .ck-powered-by {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="mb-4">
            <h2 class="mb-4">CK Editor Todo using cdn <sup style="font-size: 10px; top: -1rem;">MARKDOWN</sup> </h2>
            <a href="{{ route('local-home') }}" class="btn border shadow">Local</a>
            <a href="javascript:void(0)" class="btn border shadow border-primary">CDN</a>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <form method="POST" id="editor-form" action="{{ route('create') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Enter title</label>
                        <input class="form-control" id="title" type="text" name="title" />
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editor" class="form-label">Enter Description</label>
                        <textarea class="form-control ckeditor" name="description" id="editor" cols="30" rows="5"></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-dark" type="submit">Submit</button>
                </form>
            </div>
        </div>


        <div class="row row-cols-1 row-cols-md-5 row-cols-sm-3 g-4 mt-4">

            @forelse ($todos as $todo)
                <div class="col">
                    <div class="card h-100 border-info mb-3" style="max-width: 18rem;">
                        <div class="card-header d-flex ">
                            <span>{{ $todo->title }} </span>
                            <form action="{{ route('delete', $todo->id) }}" method="POST" class="ms-auto ">
                                @csrf
                                <button class="btn btn-sm p-0 fs-5 btn-danger text-light">
                                    <i class='bx m-1 bxs-trash-alt'></i>
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            {{-- {!! $todo->description !!} --}}
                            {!! Str::markdown($todo->description) !!}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-warning">No Todos..</p>
            @endforelse



        </div>

        <br><br>

        {{-- Ck Editor CDN link of javascripts --}}
        <script type="importmap">
        { 
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
            }
        }
    </script>

        <script type="module">
            import {
                ClassicEditor,
                Markdown,
                Bold,
                Italic,
                Link,
                Paragraph,
                Heading,
                BlockQuote,
                CodeBlock,
                List,
                Table,
                TableToolbar,
                HorizontalLine,
                Essentials,
                Undo
            } from 'ckeditor5';

            let ckEditors = document.querySelectorAll(".ckeditor");

            ckEditors.forEach((editor) => {
                ClassicEditor
                    .create(editor, {
                        plugins: [
                            Essentials,
                            Markdown,
                            Bold,
                            Italic,
                            Link,
                            Paragraph,
                            Heading,
                            BlockQuote,
                            CodeBlock,
                            List,
                            Table,
                            TableToolbar,
                            HorizontalLine,
                            Undo
                        ],
                        toolbar: {
                            items: [
                                'undo', 'redo', '|',
                                'heading', '|',
                                'bold', 'italic', '|',
                                'link', '|',
                                'bulletedList', 'numberedList', '|',
                                'blockQuote', 'codeBlock', '|',
                                'insertTable', '|',
                                'horizontalLine'
                            ]

                        }
                    })
                    .then(editor => {
                        window.editor = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>
