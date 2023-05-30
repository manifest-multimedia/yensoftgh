
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset CSS */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            color: #333333;
        }

        /* Email container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .header h1 {
            font-size: 24px;
            color: #888888;
            margin: 0;
        }

        /* Content */
        .content {
            margin-bottom: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .content p {
            margin-bottom: 10px;
        }

        .content ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .content ul li {
            margin-bottom: 5px;
        }

        /* Call-to-action button */
        .cta-button {
            text-align: center;
            margin-top: 20px;
        }

        .cta-button a {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(264.46deg, #4d7c13 -0.26%, #265416 98.84%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            /*font-weight: bold;*/
        }

        .cta-button a:hover {

                background: rgba(28, 127, 29, 0.761);
                box-shadow: 0 6px 7px -4px rgba(0,0,0,0.2);
            }


        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
        }

        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
       <!--     <h1>Yensoft SchoolDB</h1> -->
            <img src="http://127.0.0.1:8000/assets/img/logo2.png" alt="Yensoft SchoolDB">
        </div>

        <div class="content">

            <p>{{ 'Dear ' . $data['name'] }},</p>

            <p>Your account has be created successfully. We are excited to have you as a new user!</p>

            <p>Here are your account credentials:</p>

            <p>{{ $data['message'] }}</p>

            <div class="cta-button">
                <a href="https://schooldb.yensoftgh.com/login">Login Now</a>
            </div>


            <p>Please make sure to keep your password secure and do not share it with anyone.</p>

            <p>If you have any questions or need further assistance, feel free to contact our support
                    team at <a href="mailto:support@yensoftgh.com">support@yensoftgh.com</a>.</p>

            <p>Regards,<br>
            Team Yensoft</p>
        </div>

        <div class="footer">
            <p>This is an automated email. If you received it by mistake, you don’t need to do anything.
                For more info, visit <a href="http://schooldb.yensoftgh.com/">Yensoft GH</a>.
            </p>
            <p><a href="http://schooldb.yensoftgh.com/">Privacy Policy</a> |
                <a href="http://schooldb.yensoftgh.com/">Terms of Use</a></p>
        </div>
    </div>
</body>
</html>
