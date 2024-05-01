<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
</head>
<body>

<table width="100%">
    <tr>
        <td valign="top"><img src="{{ $company_logo }}" alt="logo" width="70px" height="70px"></td>
        <td align="right">
            <h3>{{ $company_name }}</h3>
            <pre>{{ $company_address }}</pre>
        </td>
    </tr>
</table>

<br/>

<table width="100%">
    <thead style="background-color: lightgray;">
    <tr>
        @foreach($table_headers as $header) <th> {{ $header }} </th> @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($table_rows as $row)
        <tr>
            @foreach($row as $cell) <td> {{ $cell }} </td> @endforeach
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="{{ count($table_headers) - 1 }}" align="right">Total</td>
        <td align="right" class="gray"> {{ $total }} </td>
    </tr>
    </tfoot>
</table>

</body>
</html>
