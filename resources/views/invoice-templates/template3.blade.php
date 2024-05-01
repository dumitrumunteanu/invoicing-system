
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style type="text/css">
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ $company_logo }}" alt="logo">
    </div>
    <h1>INVOICE</h1>
    <div id="company" class="clearfix">
        <div>{{ $company_name }}</div>
        <div><pre>{{ $company_address }}</pre></div>
    </div>
    <div id="project">
        <div><span>ISSUED DATE</span> {{now()->format('Y/m/d')}}</div>
    </div>
</header>
<main>
    <table width="100%">
        <thead>
        <tr>
            @foreach($table_headers as $header) <th style="text-transform: uppercase"> {{ $header }} </th> @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($table_rows as $row)
            <tr>
                @foreach($row as $cell) <td> {{ $cell }} </td> @endforeach
            </tr>
        @endforeach
        <tr>
            <td colspan="{{ count($table_headers) - 1 }}" class="grand total">TOTAL</td>
            <td class="grand total">{{ $total }}</td>
        </tr>
        </tbody>
    </table>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>
