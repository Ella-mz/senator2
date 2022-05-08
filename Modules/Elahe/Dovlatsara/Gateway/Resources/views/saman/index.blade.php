<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<script>
    var RedirectURL='{{$call_back_url}}';
    var token='{{$merchant_id}}';

    var form = document.createElement("form");
    form.setAttribute("id", "form1");
    form.setAttribute("method", "POST");

    form.setAttribute("action", "https://sep.shaparak.ir/payment.aspx");
    form.setAttribute("target", "_self");
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("name", "token");
    hiddenField.setAttribute("value", token);
    form.appendChild(hiddenField);
    var hiddenField2 = document.createElement("input");
    hiddenField2.setAttribute("name", "RedirectURL");
    hiddenField2.setAttribute("value", RedirectURL);
    form.appendChild(hiddenField2);
    document.body.appendChild(form);

    form.submit();

    document.body.removeChild(form);
</script>
<script>
    document.getElementById("form1"). submit();
</script>
</body>
</html>
