<!-- Sign in Success -->
<script type="text/javascript">
    if (window?.location?.href?.indexOf('SignInsuccess') > -1) {
        Swal.fire({
            title: 'Sign In Success!',
            icon: 'success',
            text: 'Application Localcontta for Customs!',
        })
        history.replaceState({}, '', './index.php');
    }
</script>
<!-- End Sign in Success -->
