<!-- SHOW DATA SHIPMENT CUSTOM PROCESS -->

                          <div class="modal fade" id="custom<?php echo $row['rcd_id'];?>" role="dialog">
                            <div class="modal-dialoga">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><b>[Query Result] </b> Shipment Custom Details</h4>
                                </div>
                                <?php 
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta'); 
                                $role = mysql_query("SELECT * FROM tb_record_ship_cus WHERE rcd_id = '$row[rcd_id]' ");
                                $cus = mysql_fetch_array($role);
                                ?> 
                                <div class="modal-body">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>PEB Create</label>
                                        <input type="date" name="create_peb" class="form-control" value="<?php echo $cus['rcd_cus_peb_date'];?>"  placeholder="create peb" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>PEB FILE</label>
                                        <a href="<?php echo $cus['peb_file'];?>" target="_BLANK"><button class="#">View</button></a>
                                      </div>
                                      <div class="form-group">
                                        <label>Transmit Date</label>
                                        <input type="date" name="transmit_date" class="form-control" value="<?php echo $cus['rcd_cus_peb_transmit'];?>"  placeholder="TransmitDate" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>No.Aju</label>
                                        <input type="text" name="no_aju" class="form-control"  value="<?php echo $cus['rcd_cus_no_aju'];?>"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>rcd_cus_peb_nopen</label>
                                        <input type="date" name="peb_nopen" value="<?php echo $cus['rcd_cus_peb_nopen'];?>"  class="form-control"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>rcd_cus_npe_date</label>
                                        <input type="date" name="npe_date" value="<?php echo $cus['rcd_cus_npe_date'];?>"  class="form-control"  readonly>
                                      </div>
                                      <div class="form-group">
                                        <label>NPE FILE</label>
                                        <a href="<?php echo $cus['npe_file'];?>" target="_BLANK"><button class="#">View</button></a>
                                      </div>
                                    </div>                         
                                  </div>    
                                  <div class="modal-footer">
                                  </div>                                                                        
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- END OF SHOW DATA CUSTOM PROCESS -->