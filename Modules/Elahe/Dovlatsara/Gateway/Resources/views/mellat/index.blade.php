<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<script>
    var merchant_id='{{$merchant_id}}';

    var form = document.createElement("form");
    form.setAttribute("id", "form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "https://bpm.shaparak.ir/pgwchannel/startpay.mellat");
    form.setAttribute("target", "_self");
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("name", "RefId");
    hiddenField.setAttribute("value", merchant_id);
    hiddenField.setAttribute("id", 'RefId');
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
</script>
<script>
    document.getElementById("form"). submit();
</script>
</body>
</html>
