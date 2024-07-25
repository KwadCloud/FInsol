@extends('layout')
@section('seo')
    <title>Refund | Sampurna Suvidha Kendra</title>
@endsection
@section('content')
    <style>
        [data-custom-class='body'],
        [data-custom-class='body'] * {
            background: transparent !important;
            position: relative;
        }

        [data-custom-class='title'],
        [data-custom-class='title'] * {
            font-family: Arial !important;
            font-size: 2rem !important;
            color: #000000 !important;
            text-align: center;
        }

        [data-custom-class='subtitle'],
        [data-custom-class='subtitle'] * {
            font-family: Arial !important;
            color: #595959 !important;
            font-size: 1.4rem !important;
            text-align: center;
        }

        [data-custom-class='heading_1'],
        [data-custom-class='heading_1'] * {
            font-family: Arial !important;
            font-size: 1.5rem !important;
            color: #000000 !important;
        }

        [data-custom-class='heading_2'],
        [data-custom-class='heading_2'] * {
            font-family: Arial !important;
            font-size: 1.4rem !important;
            color: #000000 !important;
        }

        [data-custom-class='body_text'],
        [data-custom-class='body_text'] * {
            color: #595959 !important;
            font-size: 1.25rem !important;
            font-family: Arial !important;
        }

        [data-custom-class='link'],
        [data-custom-class='link'] * {
            color: #3030F1 !important;
            font-size: 1.25rem !important;
            font-family: Arial !important;
            word-break: break-word !important;
        }

        .lh-1 {
            line-height: 1;
        }

        .lh-15 {
            line-height: 1.5;
        }
    </style>
    <div class="container mt-8 mb-8" data-custom-class="body">
        <div style="text-align:center;">
            <h1 data-custom-class="title" style="line-height: 150%;"><strong>RETURN POLICY</strong></h1>
            <p style="line-height: 150%;"><strong>Last updated <span class="question">July 20, 2023</span></strong></p>
        </div>

        <div data-custom-class="heading_1" style="font-size: 19px;"><strong>REFUNDS</strong></div>
        <p>All sales are final and no refund will be issued.</p>

        <div data-custom-class="heading_1"><strong>QUESTIONS</strong></div>
        <p>If you have any questions concerning our return policy, please contact us at: <a
                href="mailto:contact@sampurnasuvidhakendra.com" class="question">contact@sampurnasuvidhakendra.com</a></p>

        <style>
            ul {
                list-style-type: square;
            }

            ul>li>ul {
                list-style-type: circle;
            }

            ul>li>ul>li>ul {
                list-style-type: square;
            }

            ol li {
                font-family: Arial;
            }
        </style>
    </div>
@endsection
