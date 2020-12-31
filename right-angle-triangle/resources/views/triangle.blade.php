<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Right Angle Triangle</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">

            <h2>Right Angle Triangles.</h2>
            <div class="row justify-content-center">
                <div class="col-6">
                    <img src="{{asset('img/triangle.png')}}" class="img-thumbnail" alt="right angle triangle">
                </div>
            </div>
            <form method="POST" action="">
                @csrf
                <label for="a">a</label>
                <input id="a" name="a" type="text" class="@error('a') is-invalid @enderror" value="{{ $a ?? '' }}">
                <label for="b">b</label>
                <input id="b" name="b" type="text" class="@error('b') is-invalid @enderror" value="{{ $b ?? '' }}">
                <label for="c">c</label>
                <input id="c" name="c" type="text" class="@error('c') is-invalid @enderror" value="{{ $c ?? '' }}">
                <label for="theta">theta</label>
                <input id="theta" name="theta" type="text" class="@error('theta') is-invalid @enderror"
                       value="{{ $theta ?? '' }}">

                <input id="submit" type="submit">

                @if( $errors->hasAny ( 'a', 'b', 'c', 'theta' ) )
                    <div class="alert alert-danger">{{$errors}}</div>
                @endif
            </form>

            <table id="recent-results" class="table">
                <thead>
                    <tr>
                        <th>uniqueId</th>
                        <th>theta (&#176;)</th>
                        <th>a (units)</th>
                        <th>b (units)</th>
                        <th>c (units)</th>
                        <th>date</th>
                        <th>Values modified</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $triangles as $triangle )
                    <tr>
                        <td>{{$triangle->id}}</td>
                        <td>{{$triangle->theta}}</td>
                        <td>{{$triangle->a}}</td>
                        <td>{{$triangle->b}}</td>
                        <td>{{$triangle->c}}</td>
                        <td>{{$triangle->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>