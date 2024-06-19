<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->

    <!-- jQuery -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <style>


       ul {
            list-style-type: none;
            padding: 0;
        }
       #results li {
            background-color: #e9ecef;
            border: 1px solid #e3e6e8;
            padding: 10px;
            margin-top: 3px;
            border-radius: 5px;
        }
        
        
        .verify-container {
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 16px;
        }
        
      
        .mines-result {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 创建五列 */
         
            padding: 10px;
            width: 500px; /* 设定容器宽度 */
            gap: 3px; /* 设置间距 */
          
        }
        .mines-result .item {
            aspect-ratio: 1; /* 使项目成为正方形 */
            background-color: #e9ecef;
             border: 1px solid #e3e6e8;
            border-radius: 5px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 40px;
            box-sizing: border-box; /* 让边框和内边距包含在宽度之内 */
        }
        .dargan-result-clo-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 创建四列 */
            grid-template-rows: repeat(9, 40px); /* 创建九行 */
            gap: 3px; /* 设置间距 */
            padding: 10px;
        }

        .dargan-result-clo-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 创建四列 */
            grid-template-rows: repeat(9, 40px); /* 创建九行 */
            gap: 3px; /* 设置间距 */
            padding: 10px;
        }

        .dargan-result-clo-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 创建四列 */
            grid-template-rows: repeat(9, 40px); /* 创建九行 */
            gap: 3px; /* 设置间距 */
            padding: 10px;
        }

        .dargan-result .item {
            background-color:  #eb0c0c;
             border: 1px solid #e3e6e8;
            border-radius: 5px;
            text-align: center;
            line-height: 40px;
            box-sizing: border-box; /* 让边框和内边距包含在宽度之内 */
        }
        .bg-gray{
            background-color: #e9ecef1!important;
           
        }

        .bg-red{
            background-color: #eb0c0c!important;
          
           
        }
        #results{
            max-width: 670px;
        }
     
    </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div >
        @yield('content')
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
</body>
</html>
