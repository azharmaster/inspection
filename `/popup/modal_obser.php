<!-- Edit Modal-->

<div class="modal fade bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
                <div class="modal-header">
				<h5 class="modal-title float-left" id="exampleModalLabel">Update Finding/ Observation/ Action Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
                </div>
                <div class="modal-body">
				<form class="form-horizontal row-fluid"  method="POST" >
				<div class="container-fluid">
				
				<input type="hidden" style="width:350px;" class="form-control" name="idd" id="idd" >
					

						

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Finding / Observation / Action Item :</span>
						<textarea  name="obser" class="form-control" style="height: 300px" id="eobser" ></textarea>
						
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Category :</span>
						<select style="width:350px;" class="form-control" name="cat" id="ecat" required>
							<option value="">Choose </option>
							<?php 
								$query=mysqli_query($con,"SELECT * FROM category");
								while($row=mysqli_fetch_array($query))
								{ ?>		
							<option value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Assignee :</span>
						<select style="width:350px;" class="form-control" name="dept" id="edept" required>
							<option value="">Choose </option>
							<?php 
								$query=mysqli_query($con,"SELECT * FROM dept");
								while($row=mysqli_fetch_array($query))
								{ ?>		
							<option value="<?php echo $row['id'] ?>"><?php echo $row['dept'] ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Target Date :</span>
						<input type="date" style="width:350px;" class="form-control" name="target" id="etdate" >
					</div>

					
					
				
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <!-- <button type="button" name="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> </i> Update</button> -->
					<button   name="update" class="btn btn-success" data-toggle="modal" data-target="#modal-default" >Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
	</div>
<!-- /.modal -->