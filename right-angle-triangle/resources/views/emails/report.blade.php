<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <h2>
            Triangle Table Entries:
        </h2>
        <table id="recent-results" class="table">
            <thead style="background-color: #38c172;">
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
                @foreach( $triangleLog as $triangle )
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
    </body>
</html>