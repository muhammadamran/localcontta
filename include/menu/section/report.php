<li class="section">
    <div>
        REPORT SECTION
    </div>
</li>
<li>
    <a href="#"><i class="fa fa-folder-open fa-fw"></i> Report<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">                           
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fas fa-calendar-check"></i> Daily Report<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="import_daily_report.php?datenow=<?= date('Y-m-d');?>"><i class="fas fa-caret-right" aria-hidden="true"></i> Daily Report - Import</a>
                </li>
                <li>
                    <a href="export_daily_report.php?datenow=<?= date('Y-m-d');?>"><i class="fas fa-caret-right" aria-hidden="true"></i> Daily Report - Export</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fas fa-plane"></i> Air - Import Record<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="air_import_report_process.php?month=0&year=0"><i class="fas fa-caret-right" aria-hidden="true"></i> Report Process</a>
                </li>
                <li>
                    <a href="air_import_uncompleted_record.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Uncompleted Record</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fas fa-ship"></i> Sea - Import Record<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="import_report_process.php?month=0&year=0"><i class="fas fa-caret-right" aria-hidden="true"></i> Report Process</a>
                </li>
                <li>
                    <a href="import_uncompleted_record.php"><i class="fas fa-caret-right" aria-hidden="true"></i> Uncompleted Record</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-caret-right" aria-hidden="true"></i> Customer Report<span class="fa arrow"></span></a>
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