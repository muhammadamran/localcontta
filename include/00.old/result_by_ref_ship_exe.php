<!-- SHOW DATA SHIPMENT EXECUTION PROCESS -->

                          <div class="modal fade" id="exe<?php echo $row['rcd_id'];?>" role="dialog">
                            <div class="modal-dialoga">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><b>[Query Result] </b> Shipment Execution Details</h4>
                                </div>
                                <?php 
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta');  
                                $role = mysql_query("SELECT * FROM tb_record_ship_exe WHERE rcd_id = '$row[rcd_id]' ");
                                $exe = mysql_fetch_array($role);
                                ?> 
                                <div class="modal-body">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>DO No.</label>
                                        <input type="text" name="rcd_exe_do_no" class="form-control" value="<?php echo $exe['rcd_exe_do_no'];?>" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>Liner</label>
                                        <input type="text" name="rcd_exe_liner" class="form-control" value="<?php echo $exe['rcd_exe_liner'];?>" readonly>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>TruckArrived</label>
                                        <input type="text" name="rcd_exe_truck_arrived_now" class="form-control" value="<?php echo $exe['rcd_exe_truck_arrived'];?>" readonly>
                                      </div>                              
                                      <div class="form-group col-md-6">
                                        <label>StuffingStart</label>
                                        <input type="text" name="rcd_exe_stuff_start_now" value="<?php echo $exe['rcd_exe_stuff_start'];?>" class="form-control" readonly>
                                      </div>                              
                                      <div class="form-group">
                                        <label>Container No.</label>
                                        <input type="text" name="rcd_exe_con_no" value="<?php echo $exe['rcd_exe_con_no'];?>" class="form-control"  readonly>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>Cont. Leave</label>
                                        <input type="text" name="rcd_exe_con_leave_now" value="<?php echo $exe['rcd_exe_con_leave'];?>"  class="form-control" readonly>
                                        <input type="hidden" name="rcd_id" value="<?php echo $exe['rcd_id'];?>"  class="form-control" >
                                      </div>                              
                                      <div class="form-group col-md-6">
                                        <label>Container in CY</label>
                                        <input type="text" name="rcd_exe_con_cy_now" value="<?php echo $exe['rcd_exe_con_cy'];?>" class="form-control" readonly>
                                      </div>                              
                                    </div>                         
                                  </div>                                                                           
                                </div>  
                                <div class="modal-footer">
                                  <br>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- END OF SHOW DATA execution PROCESS -->