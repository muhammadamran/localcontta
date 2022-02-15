<!-- SHOW DATA SHIPMENT ARRANGEMENT -->

                          <div class="modal fade" id="arr<?php echo $row['rcd_id'];?>" role="dialog">
                            <div class="modal-dialoga">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><b>[Query Result] </b> Shipment Arrangement Details</h4>
                                </div>
                                <div class="modal-body"> 
                                  <?php 
                                  mysql_connect('localhost', 'root','');
                                  mysql_select_db('contta'); 
                                  $role = mysql_query("SELECT * FROM tb_record_ship_arr WHERE rcd_id = '$row[rcd_id]' ");
                                  $arr = mysql_fetch_array($role);
                                  ?>                           
                                  <div class="col-md-12">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>CreateSIPL</label>
                                        <input type="date" name="create_sipl" class="form-control" value="<?php echo $arr['rcd_ar_sipl'];?>"  placeholder="ShipmentPlanDate" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>CreateEMS</label>
                                        <input type="date" name="create_ems" class="form-control" value="<?php echo $arr['rcd_ar_ems'];?>"  placeholder="ShipmentPlanDate" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>No.Aju</label>
                                        <input type="text" name="no_aju" class="form-control"  value="<?php echo $arr['rcd_ar_aju'];?>"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>StuffingDate</label>
                                        <input type="date" name="StuffingDate" value="<?php echo $arr['rcd_ar_stuff'];?>"  class="form-control"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>Create SAC</label>
                                        <input type="date" name="create_sac" value="<?php echo $arr['rcd_ar_sac'];?>"  class="form-control"  readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Revisi SAC</label>
                                        <input type="text" name="revise_sac" value="<?php echo $arr['rcd_ar_sac_rev'];?>"  class="form-control"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>SAC No. Pen</label>
                                        <input type="date" name="sac_no_pen" value="<?php echo $arr['rcd_ar_sac_no'];?>"  class="form-control" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>Approval for CK5</label>
                                        <input type="date" name="app_ck5" value="<?php echo $arr['rcd_ar_ck2_app'];?>"  class="form-control" readonly>
                                      </div>                                    
                                      <div class="form-group">
                                        <label>Closed CK 5</label>
                                        <input type="date" name="close_ck5" value="<?php echo $arr['rcd_ar_ck5_close'];?>"  class="form-control"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" name="remark"  value="<?php echo $arr['remarks'];?>" class="form-control"  readonly>
                                      </div>
                                    </div>                          
                                  </div>                                                                            
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- END OF SHOW DATA SHIPMENT ARRANGEMENT -->