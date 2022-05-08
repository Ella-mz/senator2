<!doctype html>
<html>
<head>
    <link rel="shortcut icon" type="image/jpg"
          href="{{asset(\Modules\Setting\Entities\Setting::where('title', 'favicon_file')->first()->str_value)}}">
    <style>
        body {
            background: transparent
        }

        #loader {
            bottom: 0;
            height: 175px;
            left: 0;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            width: 175px
        }

        #loader {
            bottom: 0;
            height: 175px;
            left: 0;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            width: 175px
        }

        #loader .dot {
            bottom: 0;
            height: 100%;
            left: 0;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            width: 90px
        }

        #loader .dot::before {
            border-radius: 100%;
            content: "";
            height: 90px;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transform: scale(0);
            width: 87.5px
        }

        #loader .dot:nth-child(7n+1) {
            transform: rotate(45deg)
        }

        #loader .dot:nth-child(7n+1)::before {
            animation: 2s linear 0.3s normal none infinite running load;
            background: #FFD909 none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+2) {
            transform: rotate(90deg)
        }

        #loader .dot:nth-child(7n+2)::before {
            animation: 2s linear 0.3s normal none infinite running load;
            background: #FFDE2C none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+3) {
            transform: rotate(135deg)
        }

        #loader .dot:nth-child(7n+3)::before {
            animation: 2s linear 0.4s normal none infinite running load;
            background: #FFE34F none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+4) {
            transform: rotate(180deg)
        }

        #loader .dot:nth-child(7n+1)::before {
            animation: 2s linear 0.3s normal none infinite running load;
            background: #FFE972 none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+2) {
            transform: rotate(90deg)
        }

        #loader .dot:nth-child(7n+2)::before {
            animation: 2s linear 0.3s normal none infinite running load;
            background: #FFEE95 none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+3) {
            transform: rotate(135deg)
        }

        #loader .dot:nth-child(7n+3)::before {
            animation: 2s linear 0.4s normal none infinite running load;
            background: #FFF4B8 none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+4) {
            transform: rotate(180deg)
        }

        #loader .dot:nth-child(7n+4)::before {
            animation: 2s linear 0.5s normal none infinite running load;
            background: #FFF9DB none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+5) {
            transform: rotate(225deg)
        }

        #loader .dot:nth-child(7n+5)::before {
            animation: 2s linear 0.6s normal none infinite running load;
            background: #FFFEEF none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+6) {
            transform: rotate(270deg)
        }

        #loader .dot:nth-child(7n+6)::before {
            animation: 2s linear 0.7s normal none infinite running load;
            background: #c7bbcc none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+7) {
            transform: rotate(315deg)
        }

        #loader .dot:nth-child(7n+7)::before {
            animation: 2s linear 0.8s normal none infinite running load;
            background: #dad1dd none repeat scroll 0 0
        }

        #loader .dot:nth-child(7n+8) {
            transform: rotate(360deg)
        }

        #loader .dot:nth-child(7n+8)::before {
            animation: 2s linear 0.9s normal none infinite running load;
            background: #ece8ee none repeat scroll 0 0
        }

        #loader .lading {
            background-position: 50% 50%;
            background-repeat: no-repeat;
            bottom: -40px;
            height: 20px;
            left: 0;
            position: absolute;
            right: 0;
            width: 180px
        }

        @keyframes load {
            100% {
                opacity: 0;
                transform: scale(1)
            }
        }

        @keyframes load {
            100% {
                opacity: 0;
                transform: scale(1)
            }
        }

        .preloaderContent.close {
            display: none;
        }

        .preloaderContent.open {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-color: #00000060;
            display: block;
            z-index: 10;
        }

        /*#preloaderContent{*/
        /*    display: none;*/
        /*    z-index: 90;*/
        /*}*/
    </style>

</head>
<body id="preloaderBody">
<div class="preloaderContent close" id="preloaderContent">
    <div class="row">
        <div id="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="lading"></div>
        </div>
    </div>
</div>

</body>


</html>
