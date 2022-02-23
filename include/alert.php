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

<!-- Managemen Users -->
<script type="text/javascript">
    // Input - Add
    if (window?.location?.href?.indexOf('InputSuccess') > -1) {
        Swal.fire({
            title: 'Success Alert!',
            icon: 'success',
            text: 'Data saved successfully!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }

    if (window?.location?.href?.indexOf('InputFailed') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Data failed to save, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }
    // End Input - Add

    // Update Data
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Update Alert!',
            icon: 'info',
            text: 'Data updated successfully!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }

    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Update Alert!',
            icon: 'info',
            text: 'Data failed to updated, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }
    // End Update Data

    // Delete
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data delete successfully!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }

    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data failed to delete, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }
    // End Delete

    // Change Password
    if (window?.location?.href?.indexOf('UpdatePassSuccess') > -1) {
        Swal.fire({
            title: 'Update Alert!',
            icon: 'info',
            text: 'Data updated successfully!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }

    if (window?.location?.href?.indexOf('UpdatePassFailed') > -1) {
        Swal.fire({
            title: 'Update Alert!',
            icon: 'info',
            text: 'Data failed to updated, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_user.php');
    }
    // End Change Password
</script>

<!-- Consignee -->
<script type="text/javascript">
    // Input - Add
    if (window?.location?.href?.indexOf('CaddSuccess') > -1) {
        Swal.fire({
            title: 'Success Alert!',
            icon: 'success',
            text: 'Data saved successfully!',
        })
        history.replaceState({}, '', './iou_adm_cnee.php');
    }

    if (window?.location?.href?.indexOf('CaddFailed') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Data failed to save, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_cnee.php');
    }

    if (window?.location?.href?.indexOf('CaddReady') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Consignee Name already registered, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_cnee.php');
    }
    // End Input - Add

    // Update Data
    // End Update Data

    // Delete
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data delete successfully!',
        })
        history.replaceState({}, '', './iou_adm_cnee.php');
    }

    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data failed to delete, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_cnee.php');
    }
    // End Delete
</script>

<!-- Swal.fire({
  icon: 'info',
  title: 'Failed Input!',
  imageWidth: 400,
  imageHeight: 250,
  imageAlt: 'Custom image',
  html: '<font style="font-size: 12px;font-weight: 300;">Make sure the mandarory input is not empty. <br><b>Pay attention to the input label <font style="color: red">*</font></b></font>',
  showCloseButton: false,
  showCancelButton: false,
  focusConfirm: false,
  confirmButtonText: 'OK'
}) -->
<!-- End Sign in Success -->
