<!-- Edit Modal-->

<div class="modal fade bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
                <div class="modal-header">
				<h5 class="modal-title float-left" id="exampleModalLabel">Update Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
                </div>
                <div class="modal-body">
				<form class="form-horizontal row-fluid"  method="POST" >
				<div class="container-fluid">
				
				<input type="hidden" style="width:350px;" class="form-control" name="idd" id="idd" >
					

				<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Staf ID :</span>
						<input type="text" style="width:350px;" class="form-control" name="stafid" id="estaf" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Name :</span>
						<input type="text" style="width:350px;" class="form-control" name="name" id="ename" >
					</div>
					
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Contact No :</span>
						<input type="number" style="width:350px;" class="form-control" name="contact" id="enotel" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Email :</span>
						<input type="email" style="width:350px;" class="form-control" name="email" id="eemail" >
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Role :</span>
						
						<select style="width:350px;" class="form-control" name="role" id="eacl" required>
							<option value="">Choose </option>
							<option value="1">Admin </option>
							<option value="2">Department </option>
						</select>
					</div>

					
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Department :</span>
						
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