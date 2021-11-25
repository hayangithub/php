 <div class="modal fade bs-example-modal-lg" id="editRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close closeEdit" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Class / Lab / Hall</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="introomidEdit" id="introomidEdit" value=""  />
                            <div class="form-group">
                                <label>Block</label>
                                <select class="form-control" name="chblock" id="chblock_edit">   
                                    <?php foreach ($blocks as $row) { ?>
                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="vchroomtype" id="vchroomtype_edit">
                                    <?php foreach ($roomtypes as $row) { ?>
                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Class / Lab / Hall No.</label>
                                <input type="text" class="form-control" id="vchroomno_edit" maxlength="30" name="vchroomno">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="text" class="form-control numericOnly" id="capacity_edit" maxlength="3" name="capacity">
                                <span class="text-danger"></span>
                            </div>
                             <?php $userData = getUserSessionData(); ?>
                            <div class="form-group">
                                <label> Person In Charge (Main) </label>
                                <small class="req">*</small> 
                                <select class="selectpicker form-control effect-7" id="intuseridEdit" name="intuseridEdit" style="width:100%" multiple data-max-options="1" data-live-search="true"
                                <?php if (in_array("MA", $userData['roles'])) { ?>
                                            disabled="true"
                                        <?php } ?> >
                                    <?php foreach ($users as $row) { ?>   
                                        <option value="<?php echo $row['intuserid']; ?>"><?php echo $row['vchfirstname'] . " " . $row['vchlastname']; ?></option>
                                    <?php } ?>                                                                 }
                                </select>
                                <span class="text-danger intuseridEditError"></span>
                            </div>

                             <div class="form-group">
                                <label> Person In Charge (Optional) </label>
                                <small class="req"></small> 
                                <select class="selectpicker form-control effect-7" id="intuseridEdit2" name="intuseridEdit2" style="width:100%" multiple data-max-options="1" data-live-search="true"
                                <?php if (in_array("MA", $userData['roles'])) { ?>
                                            disabled="true"
                                        <?php } ?> >
                                    <?php foreach ($users as $row) { ?>   
                                        <option value="<?php echo $row['intuserid']; ?>"><?php echo $row['vchfirstname'] . " " . $row['vchlastname']; ?></option>
                                    <?php } ?>                                                                 }
                                </select>
                                <span class="text-danger intuseridEdit2Error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status_edit">
                                    <?php foreach ($enable_flag as $row) { ?>
                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-success" onclick="editRoomDone();">Save</button>
                        <button type="button" id="cancelEdit" class="btn btn-round btn-danger" >Cancel</button>
                       
                    </div>

                </div>
            </div>
        </div>