@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Category</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/categories" method="POST" class="mb-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name Category</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    required autofocus value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    required value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>

    <script>
        // const name = document.querySelector('#name');
        // const slug = document.querySelector('#slug');

        // name.addEventListener('change', function() {
        //     fetch('/dashboard/categories/checkSlug?name=' + name.value)
        //         .then(response => response.json())
        //         .then(data => slug.value = data.slug)
        // });

        document.addEventListener('DOMContentLoaded', function() {
            const name = document.querySelector('#name');
            const slug = document.querySelector('#slug');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            name.addEventListener('change', function() {
                fetch('/dashboard/categories/checkSlug?name=' + encodeURIComponent(name.value), {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => slug.value = data.slug)
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
