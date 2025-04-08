<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    {{-- css_page --}}
    {{-- <link rel="stylesheet" href="css/course.css"> --}}
    <style>
        body {
            height: 100vh;
            background-color: rgb(238, 238, 238);
        }

        .cover {
            box-sizing: border-box;
        }

        .cover-head {
            /* height: 150px; */
            background-color: blueviolet;
            padding: 20px;
        }

        .head {
            background-color: rgb(255, 255, 255);
            min-height: 100vh;
            border-radius: 10px;
        }

        .one {
            height: 30px;
            display: flex;
            align-items: center;
            padding: 30px
        }


        .three {
            display: flex;
        }

        .box {
            height: 30px;
            width: 200px;
            border: 1px solid;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            margin-left: 20px;
        }

        .third-sub {
            display: flex;
            align-items: center;
        }

        .nav {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid;
            margin: 5px
        }

        .search {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 500px;
            margin-top: 5%;
        }

        /* thead {
            height: 30px;
        } */

        h5 {
            margin-bottom: 50px;
        }


        label {
            width: 180px
        }

        .buttons {
            margin-left: 200px
        }

        #delete_form {
            height: 200px;
        }

        #add_form {
            height: 350px;
        }

        #role_permission:hover {
            background-color: rgb(36, 153, 32);
        }

        #profile_modal {
            margin-top: 100px;
        }

        #settings_modal {
            margin-top: 100px;
        }
        #profile_modal {
            margin-top: 100px;
        }

        #support_modal {
            margin-top: 100px;
        }
        #import_modal {
            margin-top: 100px;
        }

        th {
            /* width: 200px; */
        }

        table {
            text-align: center
        }
    </style>
</head>

<body>
    <div class="cover">
        <div class="cover-head">
            <div class="head">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
