<li class="section">
    <div>
        ADMINISTRATION SECTION
    </div>
</li>
<li class="<?= $uriSegments[2] == 'iou_adm_user.php' || $uriSegments[2] == 'iou_adm_freight.php' || $uriSegments[2] == 'iou_adm_cnee.php' || $uriSegments[2] == 'iou_adm_shipper.php' || $uriSegments[2] == 'iou_adm_trucker.php' || $uriSegments[2] == 'iou_adm_docs.php' || $uriSegments[2] == 'iou_adm_rate.php' || $uriSegments[2] == 'iou_adm_record.php' ? 'active' : '' ?>">
    <a class="<?= $uriSegments[2] == 'iou_adm_user.php' || $uriSegments[2] == 'iou_adm_freight.php' || $uriSegments[2] == 'iou_adm_cnee.php' || $uriSegments[2] == 'iou_adm_shipper.php' || $uriSegments[2] == 'iou_adm_trucker.php' || $uriSegments[2] == 'iou_adm_docs.php' || $uriSegments[2] == 'iou_adm_rate.php' || $uriSegments[2] == 'iou_adm_record.php' ? 'active' : '' ?>" href="#"><i class="fa fa-atlas fa-fw"></i> Administration<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="<?= $uriSegments[2] == 'iou_adm_user.php' ? 'show' : '' ?>">
            <a href="iou_adm_user.php">Management Users</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_freight.php' ? 'show' : '' ?>">
            <a href="iou_adm_freight.php">Freight</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_cnee.php' ? 'show' : '' ?>">
            <a href="iou_adm_cnee.php">Consignee</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_shipper.php' ? 'show' : '' ?>">
            <a href="iou_adm_shipper.php">Shipper</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_trucker.php' ? 'show' : '' ?>">
            <a href="iou_adm_trucker.php">Trucker</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_docs.php' ? 'show' : '' ?>">
            <a href="iou_adm_docs.php">Document Type</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_rate.php' ? 'show' : '' ?>">
            <a href="iou_adm_rate.php">Pricing/Rate</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_record.php' ? 'show' : '' ?>">
            <a href="iou_adm_record.php?ref=000000&type=39393">Record Management</a>
        </li>
    </ul>
</li>