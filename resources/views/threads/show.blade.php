@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{ $thread->owner->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads._reply')
                    <br />
                @endforeach
            </div>
        </div>

        <div class="row justify-content-center">
            @if(auth()->check())
            <div class="col-md-8">
                <form method="post" action="{{ $thread->path() . '/replies'  }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
            @else
            <div class="col-md-8">
                <p>Please <a href="/login">sing in</a> to participate in the discussion</p>
            </div>
            @endif
        </div>

    </div>
@endsection
