<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #a76081;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>{{ $company_name }}</h3>
                <pre>{{ $company_address }}</pre>
            </td>
            <td align="center">
                <img src="{{ $company_logo }}" alt="Logo" width="64" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">
                <h1>INVOICE</h1>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <table width="100%">
        <thead>
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
            <td colspan="{{ count($table_headers) - 1 }}" align="left">Total</td>
            <td align="left" class="gray">{{ $total }}</td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0; left:0; right:0">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
        </tr>
    </table>
</div>
</body>
</html>
