<body>
<form id="payform" action="https://uat.esewa.com.np/epay/main" method="POST">
    <input value="{{ $tAmt }}" name="tAmt" type="hidden">
    <input value="{{ $amt }}" name="amt" type="hidden">
    <input value="{{ $txAmt }}" name="txAmt" type="hidden">
    <input value="{{ $psc }}" name="psc" type="hidden">
    <input value="{{ $pdc }}" name="pdc" type="hidden">
    <input value="{{ $scd }}" name="scd" type="hidden">
    <input value="{{ $pid }}" name="pid" type="hidden">
    <input value="{{ $su }}" type="hidden" name="su">
    <input value="{{ $fu }}" type="hidden" name="fu">
</form>
</body>
<script>
    document.getElementById("payform").submit();
</script>
