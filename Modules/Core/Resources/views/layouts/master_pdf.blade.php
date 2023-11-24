<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: 'solaimanlipi', sans-serif;
        }

        @page {
            header: html_otherpageheader;
            footer: html_otherpagesfooter;
        }


        #header{
            position: fixed;
            top: 0px;
            /* border-bottom: 1px solid #000; */
            margin-bottom: 15px;
            padding-bottom: 15px;
        }

        #main{

        }

        .table{
            width: 100%;
            border-collapse: collapse;
        }

        .table tr td, .table tr th{
            border: 1px solid #aaa;
            outline: 0;
            padding: 7px;
        }

        .table tr th{
            font-weight: bold;
        }

    </style>
</head>
<body>

    @yield('content')

</body>
</html>
