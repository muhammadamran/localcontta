 <!-- SHOW DATA SHIPMENT MONITORING PROCESS -->

                          <div class="modal fade" id="mon<?php echo $row['rcd_id'];?>" role="dialog">
                            <div class="modal-dialoga">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><b>[Query Result] </b> Shipment Execution Details</h4>
                                </div>
                                <?php 
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta'); 
                                $role = mysql_query("SELECT * FROM tb_record_ship_mon WHERE rcd_id = '$row[rcd_id]' ");
                                $mon = mysql_fetch_array($role);
                                ?> 
                                <div class="modal-body">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="col-md-6">
                                        <!-- item -->
                                        <div class="form-group">
                                          <label>Closing Cont. Date</label>
                                          <input type="text" name="rcd_mon_cls_con_now" value="<?php echo $mon['rcd_mon_cls_con'];?>"  class="form-control" readonly>                                  
                                        </div>                              
                                        <!-- end item -->
                                        <!-- item -->
                                        <div class="form-group">
                                          <label>ATD</label>
                                          <input type="text" name="rcd_mon_atd_now" value="<?php echo $mon['rcd_mon_atd'];?>"  class="form-control" readonly>
                                        </div>
                                        <!-- end item -->
                                        <!-- item -->
                                        <div class="form-group">
                                          <label>ETD</label>
                                          <input type="text" name="rcd_mon_etd_now" value="<?php echo $mon['rcd_mon_etd'];?>"  class="form-control" readonly>
                                        </div>
                                        <!-- end item -->
                                        <div class="form-group">
                                          <label>POD</label>
                                          <input type="text" name="rcd_mon_pod" value="<?php echo $mon['rcd_mon_pod'];?>"  class="form-control"  readonly>
                                        </div>
                                        <div class="form-group">
                                          <label>MBL</label>
                                          <input type="text" name="rcd_mon_mbl" value="<?php echo $mon['rcd_mon_mbl'];?>"  class="form-control"  readonly>
                                        </div>
                                        <div class="form-group">
                                          <label>hBL</label>
                                          <input type="text" name="rcd_mon_hbl" value="<?php echo $mon['rcd_mon_hbl'];?>"  class="form-control"  readonly>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <!-- item -->
                                        <div class="form-group">
                                          <label>Docs Returned</label>
                                          <input type="text" name="rcd_mon_docs_return_now" value="<?php echo $mon['rcd_mon_docs_return'];?>"  class="form-control" readonly>
                                        </div>
                                        <!-- end item -->
                                        <div class="form-group">
                                          <label>Rcvd By</label>
                                          <input type="text" name="rcd_mon_rcvd_by" value="<?php echo $mon['rcd_mon_rcvd_by'];?>"  class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                          <label>Delay (days)</label>
                                          <input type="text" name="rcd_mon_delay" value="<?php echo $mon['rcd_mon_delay'];?>"  class="form-control"  readonly>
                                        </div>
                                        <div class="form-group">
                                          <label>Remarks</label>
                                          <input type="text" name="rcd_mon_remark"  value="<?php echo $mon['rcd_mon_remark'];?>" class="form-control"  readonly>        
                                        </div>
                                        <!-- item -->
                                        <div class="form-group">
                                          <label>Send Docs to CNEE</label>
                                          <input type="text" name="rcd_mon_docs_cnee_1_now" value="<?php echo $mon['rcd_mon_docs_cnee_1'];?>"  class="form-control" readonly>
                                        </div>
                                        <!-- end item -->
                                        <div class="form-group">
                                          <label>CNEE Rcvd</label>
                                          <input type="text" name="rcd_mon_docs_cnee_2_now" value="<?php echo $mon['rcd_mon_docs_cnee_2'];?>"  class="form-control" readonly>
                                        </div>
                                        <!-- end item -->                                
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
                          <!-- END OF SHOW DATA CUSTOM PROCESS -->