@extends('layouts.main')

@section('title')
    <title>Категории</title>
@endsection

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Категории</h1>
            <section>
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('category.post.index', $category->id) }}">{{ $category->title }}</a></li>

                    @endforeach
                </ul>

            </section>

        </div>

    </main>
@endsection
