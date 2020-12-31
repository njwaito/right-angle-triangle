<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Right Angle Triangle</title>
    </head>
    <body>
        <h2>Right Angle Triangles.</h2>
        @if( !empty($c) )
            <p>The hypoteneuse is: {{$c}}</p>
        @endif
        <form method="POST" action="">
            @csrf
            <label for="a">a</label>
            <input id="a" name="a" type="text" class="@error('a') is-invalid @enderror" value="{{ $a ?? '' }}">
            <label for="b">b</label>
            <input id="b" name="b" type="text" class="@error('b') is-invalid @enderror" value="{{ $b ?? '' }}">
            <label for="c">c</label>
            <input id="c" name="c" type="text" class="@error('c') is-invalid @enderror" value="{{ $c ?? '' }}">
            <label for="theta">theta</label>
            <input id="theta" name="theta" type="text" class="@error('theta') is-invalid @enderror" value="{{ $theta ?? '' }}">

            <input id="submit" type="submit">

            @if( $errors->hasAny ( 'a', 'b', 'c', 'theta' ) )
            <div class="alert alert-danger">{{$errors}}</div>
            @endif
        </form>
    </body>
</html>