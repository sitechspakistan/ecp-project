<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe("{{ (env('STRIPE_PUBLISH'))??'' }}");
    stripe.redirectToCheckout({
        sessionId: '{{$session_id}}'
    }).then(function (result) {
        
    });
</script>