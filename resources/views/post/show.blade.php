@extends('layouts.main')

@section('title')
    <title>Блог</title>
@endsection

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">{{ $date->translatedFormat('F') }}
                {{ $date->day }}, {{ $date->year }} • {{ $date->format('H:i') }} • {{ $post->comments->count() }}
                Коментария</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->preview_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        <p>{!! $post->content !!}</p>
                    </div>
                </div>

            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="py-3">
                        @auth
                            <form action="{{ route('post.like.store', $post->id) }}" method="POST">
                            @csrf
                                <span>{{ $post->liked_posts_count }}</span>
                                <button type="submit" class="border-0 bg-transparent">
                                        <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                                </button>
                            </form>
                        @endauth
                        @guest
                            <div>
                                <span>{{ $post->liked_posts_count }}</span>
                                <i class="fas fa-heart"></i>
                            </div>
                        @endguest
                    </section>

                    @if ($reletedPosts->count() > 0)
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Похожые посты</h2>
                            <div class="row">
                                @foreach ($reletedPosts as $reletedPost)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <img src="{{ asset('storage/' . $reletedPost->preview_image) }}" alt="related post"
                                            class="post-thumbnail">
                                        <p class="post-category">{{ $reletedPost->category->title }}</p>
                                        <a href="{{ route('post.show', $reletedPost->id) }}">
                                            <h5 class="post-title">{{ $reletedPost->title }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @auth()

                    <section class="comment-list mb-4">
                        <h2 class="section-title mb-5" data-aos="fade-up">Комментарий ({{ $post->comments->count() }})</h2>
                        @foreach ($post->comments as $comment)
                            <div class="comment-text mb-2">
                                <span class="username">
                                    <div>{{ $comment->user->name }}</div>
                                    <span class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                                </span><!-- /.username -->
                                {{ $comment->message }}
                            </div>
                        @endforeach
                    </section>

                    <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Отправить комментарий</h2>
                        <form action="{{ route('post.comment.store', $post->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Комментарий</label>
                                    <textarea name="message" id="comment" class="form-control" placeholder="Напишите коментарий" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Добавить" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    </section>
                    @endauth
                </div>
            </div>
        </div>
    </main>
@endsection
