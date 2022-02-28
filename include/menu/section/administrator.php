<li class="section">
    <div>
        ADMINISTRATION SECTION
    </div>
</li>
<li class="<?= $uriSegments[2] == 'iou_adm_user.php' || $uriSegments[2] == 'iou_adm_freight.php' || $uriSegments[2] == 'iou_adm_cnee.php' || $uriSegments[2] == 'iou_adm_shipper.php' || $uriSegments[2] == 'iou_adm_trucker.php' || $uriSegments[2] == 'iou_adm_docs.php' || $uriSegments[2] == 'iou_adm_rate.php' || $uriSegments[2] == 'iou_adm_record.php' ? 'active' : '' ?>">
    <a class="<?= $uriSegments[2] == 'iou_adm_user.php' || $uriSegments[2] == 'iou_adm_freight.php' || $uriSegments[2] == 'iou_adm_cnee.php' || $uriSegments[2] == 'iou_adm_shipper.php' || $uriSegments[2] == 'iou_adm_trucker.php' || $uriSegments[2] == 'iou_adm_docs.php' || $uriSegments[2] == 'iou_adm_rate.php' || $uriSegments[2] == 'iou_adm_record.php' ? 'active' : '' ?>" href="#"><i class="fa fa-atlas fa-fw"></i> Administration<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="<?= $uriSegments[2] == 'iou_adm_user.php' ? 'show' : '' ?>">
            <a href="iou_adm_user.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Management Users</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_freight.php' ? 'show' : '' ?>">
            <a href="iou_adm_freight.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Upload Freight</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_cnee.php' ? 'show' : '' ?>">
            <a href="iou_adm_cnee.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Consignee</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_shipper.php' ? 'show' : '' ?>">
            <a href="iou_adm_shipper.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Shipper</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_trucker.php' ? 'show' : '' ?>">
            <a href="iou_adm_trucker.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Trucker</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_docs.php' ? 'show' : '' ?>">
            <a href="iou_adm_docs.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Document Type</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_rate.php' ? 'show' : '' ?>">
            <a href="iou_adm_rate.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Pricing/Rate</a>
        </li>
        <!-- <li class="<?= $uriSegments[2] == 'iou_adm_record.php' ? 'show' : '' ?>">
            <a href="iou_adm_record.php?ref=000000&type=39393"><i class="fas fa-caret-right" aria-hidden="true"></i> Record Management</a>
        </li> -->
    </ul>

<li class="<?= $uriSegments[2] == 'iou_adm_record_export.php' || $uriSegments[2] == 'iou_adm_record_import.php' ? 'active' : '' ?>">
    <a class="<?= $uriSegments[2] == 'iou_adm_record_export.php' || $uriSegments[2] == 'iou_adm_record_import.php' ? 'active' : '' ?>" href="#"><i class="fas fa-tasks"></i> Record Management<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="<?= $uriSegments[2] == 'iou_adm_record_export.php' ? 'show' : '' ?>">
            <a href="iou_adm_record_export.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Export</a>
        </li>
        <li class="<?= $uriSegments[2] == 'iou_adm_record_import.php' ? 'show' : '' ?>">
            <a href="iou_adm_record_import.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Import</a>
        </li>
    </ul>
</li>