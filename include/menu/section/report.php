<li class="section">
    <div>
        REPORT SECTION
    </div>
</li>
<li>
    <a href="#"><i class="fa fa-folder-open fa-fw"></i> Report<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">                           
        <li>
            <a href="#"> Daily Report<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="import_daily_report.php?datenow=<?php echo date('Y-m-d');?>"><i class="fa fa-sitemap fa-fw"></i> Daily Report - Import</a>
                </li>
                <li>
                    <a href="export_daily_report.php?datenow=<?php echo date('Y-m-d');?>"><i class="fa fa-sitemap fa-fw"></i> Daily Report - Export</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"> Air - Import Record<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="air_import_report_process.php?month=0&year=0"><i class="fa fa-sitemap fa-fw"></i> Report Process</a>
                </li>
                <li>
                    <a href="air_import_uncompleted_record.php"><i class="fa fa-sitemap fa-fw"></i> Uncompleted Record</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"> Sea - Import Record<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="import_report_process.php?month=0&year=0"><i class="fa fa-sitemap fa-fw"></i> Report Process</a>
                </li>
                <li>
                    <a href="import_uncompleted_record.php"><i class="fa fa-sitemap fa-fw"></i> Uncompleted Record</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Customer Report<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="report_cust_siemens.php?month=0&year=0"></i> Siemens</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</li>