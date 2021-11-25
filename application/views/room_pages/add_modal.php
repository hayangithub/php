 <div class="modal fade bs-example-modal-lg addmodal" data-backdrop="static" data-keyboard="false" id="addNewRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close closeAdd" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Class / Lab / Hall</h4>
                    </div>
                    <div class="modal-body">
                        <form id="addRoomForm" method="post">
                            <div class="form-group">
                                <label>Block</label>
                                <select class="form-control" name="chblock" id="chblock">   
                                    <?php foreach ($blocks as $row) { ?>
                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="vchroomtype" id="vchroomtype">
                                    <?php foreach ($roomtypes as $row) { ?>
                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Class / Lab / Hall No.</label>
                                <input type="text" class="form-control" id="vchroomno" maxlength="30" name="vchroomno">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="text" class="form-control numericOnly" id="capacity" maxlength="3" name="capacity">
                                <span class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label> Person In Charge (Main) </label>
                                <small class="req">*</small> 
                                <select class="selectpicker form-control effect-7" id="intuseridAdd" name="intuseridAdd" style="width:100%" multiple data-max-options="1" data-live-search="true">
                                    <?php foreach ($users as $row) { ?>   
                                        <option value="<?php echo $row['intuserid']; ?>"><?php echo $row['vchfirstname'] . " " . $row['vchlastname']; ?></option>
                                    <?php } ?>                                                                    }
                                </select>
                                <span class="text-danger intuseridAddError"></span>
                            </div>
                            
                            <div class="form-group">
                                <label> Person In Charge (Optional) </label>
                                <small class="req"></small> 
                                <select class="selectpicker form-control effect-7" id="intuseridAdd2" name="intuseridAdd2" style="width:100%" multiple data-max-options="1" data-live-search="true">
                                    <?php foreach ($users as $row) { ?>   
                                        <option value="<?php echo $row['intuserid']; ?>"><?php echo $row['vchfirstname'] . " " . $row['vchlastname']; ?></option>
                                    <?php } ?>                                                                    }
                                </select>
                                <span class="text-danger intuseridAdd2Error"></span>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="A">Active</option>
                                    <option value="i">Inactive</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-success" onclick="add_room();">Save</button>
                        <button type="button" id="cancelAdd"  class="btn btn-round btn-danger">Cancel</button>
                        
                    </div>

                </div>
            </div>
        </div>