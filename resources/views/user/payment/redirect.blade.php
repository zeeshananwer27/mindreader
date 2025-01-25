<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{@site_settings("user_site_name",site_settings('site_name'))}} {{site_settings('title_separator')}} {{translate('Payment')}}</title>
</head>

<body>
<form action="{{$data->url}}" method="{{$data->method}}" id="auto_submit">
    @foreach($data->val as $k=> $v)
        <input type="hidden" name="{{$k}}" value="{{$v}}"/>
    @endforeach
</form>
<script nonce="{{ csp_nonce() }}">
    "use strict";
    document.getElementById("auto_submit").submit();
</script>
</body>

</html>
