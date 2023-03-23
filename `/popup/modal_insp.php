<!-- Edit Modal-->

<div class="modal fade bd-example-modal-lg" id="edit2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
                <div class="modal-header">
				<h5 class="modal-title float-left" id="exampleModalLabel">Update Inspection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
                </div>
                <div class="modal-body">
				<form class="form-horizontal row-fluid"  method="POST" >
				<div class="container-fluid">
				
				<input type="hidden" style="width:350px;" class="form-control" name="idd" id="idd" >
					
				<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Vessel :</span>
						<select style="width:350px;" class="form-control" name="vessel" id="evessel" required>
							<option value="">Choose </option>
							<?php 
								$query=mysqli_query($con,"SELECT * FROM vessel");
								while($row=mysqli_fetch_array($query))
								{ ?>		
							<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Name of Master :</span>
						<input type="text" style="width:350px;" class="form-control" name="master" id="emaster" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Inspection By :</span>
						<input type="text" style="width:350px;" class="form-control" name="inspby" id="einspby" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Name of Vessel Superintendent :</span>
						<input type="text" style="width:350px;" class="form-control" name="vsuper" id="evsuper" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Inspection Date :</span>
						<input type="date" style="width:350px;" class="form-control" name="inspdate" id="einspdate" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Inspection Name :</span>
						<select style="width:350px;" class="form-control" name="inspname" id="einspname" required>
							<option value="">Choose </option>
							<?php 
								$query=mysqli_query($con,"SELECT * FROM inspection");
								while($row=mysqli_fetch_array($query))
								{ ?>		
							<option value="<?php echo $row['id'] ?>"><?php echo $row['insp_name'] ?> </option>
							<?php } ?>
						</select>
					</div>


				

					
					
				
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <!-- <button type="button" name="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> </i> Update</button> -->
					<button   name="updated" class="btn btn-success" data-toggle="modal" data-target="#modal-default" >Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
	</div>
<!-- /.modal -->